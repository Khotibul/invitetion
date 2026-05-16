<?php

namespace App\Http\Controllers\Member;

use App\Models\Bank;
use App\Models\Info;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Account;
use App\Models\Package;
use App\Models\Template;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AccountInvoice;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Encryption\DecryptException;

class AccountController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

	public function __construct()
    {
        $this->middleware('guest');
    }
	
    public function signin(): Response|RedirectResponse
	{
		if (request()->get('manual') != '1' && config('services.google.client_id') && config('services.google.client_secret') && config('services.google.redirect')) {
			return redirect()->to('/auth/redirect');
		}
		return response()->view('member.auth.signin');
	}

	public function signin_store(Request $request)
	{
		$this->validate($request, [
			'email'		=> 'required|email',
			'password'	=> 'required'
		],
		[
			'email.required' => 'Tolong isi email kamu.',
			'email.email' => 'Format email kurang tepat.',
			'password.required' => 'Tolong masukan kata sandi kamu.',
		]);
		$credentials = $request->only('email', 'password');
		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			// Jika akun member dinonaktifkan oleh admin, jangan izinkan login.
			$user = Auth::user();
			if ($user && $user->role === 'member') {
				$user->loadMissing('acc');
				if ($user->acc && (string) $user->acc->actived !== '1') {
					Auth::logout();
					$request->session()->invalidate();
					$request->session()->regenerateToken();
					return back()->withErrors([
						'email' => 'Akun kamu sedang non-aktif. Silakan hubungi admin.',
					]);
				}
			}

			return redirect()->route('member.main');
		}

		return back()->withErrors([
			'email' => 'Kami tidak menemukan email kamu dalam data member, silakan untuk membuat akun baru.',
		]);
	}

	public function signup(): Response|RedirectResponse
	{
		if (request()->get('manual') != '1' && config('services.google.client_id') && config('services.google.client_secret') && config('services.google.redirect')) {
			return redirect()->to('/auth/redirect');
		}
		$bagpack = ['package' => null, 'template' => null];
		$data = json_decode(json_encode($bagpack));
		$data->package = Package::select('id', 'title', 'price')->publish()->get();
		$data->template = Template::select('id', 'title', 'file', 'grade', 'price')->publish()->orderBy('grade')->latest()->get();
		$data->bank = Bank::select('id', 'name', 'file')->publish()->get();

		return response()->view('member.auth.signup', compact('data'));
	}

	public function signup_store(Request $request, string $step): JsonResponse
	{
		$data = [];
		if ($step==1) :
			$this->validate($request, [
				'email'		=> 'required|email',
				'password'	=> 'required|confirmed',
			],
			[
				'email.required'	=> 'Email tidak boleh kosong.',
				'email.email'		=> 'Format email tidak tepat.',
				'password.required'	=> 'Kata sandi tidak boleh kosong.',
				'password.confirmed'=> 'Konfirmasi kata sandi kamu.',
			]);
			$user = User::where('email', $request->email)->count();
			if ($user > 0) :
				$data['code'] = 500;
				$data['command'] = 'retry';
				$data['message']['email'] = "Email sudah terdaftar, silahkan gunakan email baru.";
			elseif ($user == 0) :
				$data['code'] = 200;
				$data['command'] = 'next';
				$data['return'] = ['email' => $request->email, 'password' => $request->password];
			endif;
		elseif ($step==2) :
			$require = [
				'email'			=> 'required|email',
				'password'		=> 'required',
				'male_name'		=> 'required',
				'female_name'	=> 'required',
				'subdomain'		=> 'required',
				'bundle'		=> 'required',
				'preset'		=> 'required',
			];
			$inv_slug = Str::lower($request->subdomain);
			$inv_check = Invitation::select('id')->where('slug', $inv_slug)->count();
			$template = Template::select('id', 'preset', 'file', 'grade', 'price')->where('id', $request->preset)->publish()->first();
			$temp_check = $template ? 1 : 0;
			$pack_check = Package::select('id', 'price')->where('id', $request->bundle)->count();
			$package = Package::select('id', 'price', 'content')->where('id', $request->bundle)->first();
			$totalAmount = (int) ($package->price ?? 0) + (int) ($template->price ?? 0);
			if ($pack_check > 0) :
				if ($totalAmount > 0) :
					$require['payment'] = 'required';
					if ($request->payment=='manual') :
						$require['bank'] = 'required';
					endif;
				endif;
			endif;
			$this->validate($request, $require,
			[
				'male_name.required' => 'Nama pria tidak boleh kosong.',
				'female_name.required' => 'Nama wanita tidak boleh kosong.',
				'subdomain.required' => 'Subdomain tidak boleh kosong.',
				'bundle.required' => 'Pilih salah satu paket.',
				'preset.required' => 'Templat mana yg kamu suka?',
				'payment.required' => 'Pilih metode pembayaran.',
				'bank.required' => 'Pilih bank tujuan.'
			]);
			if ($inv_check == 0 && $temp_check > 0 && $pack_check > 0) :
				// Ensure selected template grade is allowed by the selected package.
				$allowedGrades = [];
				if ($package && $package->content) {
					$packContent = json_decode($package->content);
					$allowedGrades = $packContent->template ?? [];
				}
				if (!is_array($allowedGrades) || empty($allowedGrades)) {
					$allowedGrades = ['basic'];
				}
				if (!in_array($template->grade, $allowedGrades, true)) {
					$data['code'] = 500;
					$data['command'] = 'retry';
					$data['message']['preset'] = "Template tidak tersedia untuk paket ini.";
					return response()->json($data);
				}
				User::create([
					'name' => $request->male_name,
					'email' => $request->email,
					'password' => Hash::make($request->password),
					'role' => 'member'
				]);
				$credentials = $request->only('email', 'password');
				if (Auth::attempt($credentials)) :
					$request->session()->regenerate();
					$template->new_preset = json_decode($template->preset);
					$template->new_preset->cover->name->male = $request->male_name;
					$template->new_preset->cover->name->female = $request->female_name;
					$template->new_preset->profile->name->male = $request->male_name;
					$template->new_preset->profile->name->female = $request->female_name;
					$template->new_preset->rsvp->date = date('Y-m-d', strtotime('+3 days'));
					$template->new_preset->detail->calendar->date = date('Y-m-d', strtotime('+3 days'));
					$inv = Invitation::create([
						'title'		=> json_encode([$request->male_name, $request->female_name]),
						'slug'		=> $inv_slug,
						'file'		=> $template->file,
						'preset'	=> json_encode($template->new_preset),
						'user_id'	=> Auth::user()->id,
						'ip_addr'	=> $_SERVER['REMOTE_ADDR'],
						'template_id'	=> $template->id,
					]);
					$member = Account::create([
						'content'	=> json_encode(['phone'=>null, 'address'=>null]),
						'file'		=> 'avatar.png',
						'user_id'	=> Auth::user()->id,
						'ip_addr'	=> $_SERVER['REMOTE_ADDR'],
						'actived'	=> '1',
						'invitation_id'	=> $inv->id,
						'package_id'	=> $package->id,
					]);
					$invoice_column = [
						'date' => now(),
						'amount' => $totalAmount,
						'package_id'=> $package->id,
						'user_id'	=> Auth::user()->id,
						'ip_addr'	=> $_SERVER['REMOTE_ADDR'],
					];
					// Keep a minimal breakdown for admin-side verification.
					$invoiceContent = [
						'invoice_number' => '#0',
						'template_id' => $template->id,
						'template_price' => (int) ($template->price ?? 0),
						'package_price' => (int) ($package->price ?? 0),
					];
					if ($totalAmount > 0) :
						if ($request->payment=='fast') :
							// start xendit
							$secret_key = 'Basic '.config('xendit.key_auth');
							$external_id = Str::random(10);
							$data_request = Http::withHeaders([
								'Authorization' => $secret_key
							])->post('https://api.xendit.co/v2/invoices', [
								'external_id' => $external_id,
								'amount' => $totalAmount
							]);
							$data_response = $data_request->object();
							// end xendit
							$invoice_column['content'] = json_encode($invoiceContent);
							$invoice_column['status'] = $data_response->status;
							$invoice_column['payment_link'] = $data_response->invoice_url;
							$invoice_column['payment_code'] = $external_id;
						elseif ($request->payment=='manual') :
							// start manual
							$external_id = Str::random(10);
							// end manual
							$invoiceContent['bank'] = $request->bank;
							$invoice_column['content'] = json_encode($invoiceContent);
							$invoice_column['status'] = 'PENDING';
							$invoice_column['payment_link'] = '#manual';
							$invoice_column['payment_code'] = $external_id;
						endif;
					elseif ($totalAmount == 0) :
						$invoice_column['content'] = json_encode(['invoice_number'=>'#free'] + $invoiceContent);
						$invoice_column['status'] = 'CONFIRMED';
						$invoice_column['payment_link'] = '#';
						$invoice_column['payment_code'] = 'Free';
					endif;
					$invoice = AccountInvoice::create($invoice_column);
					$data['code'] = 200;
					$data['command'] = 'start';
					if ($totalAmount > 0) :
						$last_id = AccountInvoice::select('id')->where('user_id', Auth::user()->id)->whereDate('created_at', date('Y-m-d'))->first();
						$data['redirect'] = route('invoice', encrypt($last_id->id));
					elseif ($totalAmount == 0) :
						$data['redirect'] = route('member.main');
					endif;
				else :
					$data['code'] = 500;
					$data['command'] = 'retry';
					$data['message']['subdomain'] = "Auth";
				endif;
			else :
				$data['code'] = 500;
				$data['command'] = 'retry';
				$data['message']['subdomain'] = "Nama pasangan sudah digunakan.".$inv_check.$temp_check.$pack_check;
			endif;
		endif;
		
		return response()->json($data);
	}


	// google
	public function redirectToProvider()
	{
		if (!config('services.google.client_id') || !config('services.google.client_secret') || !config('services.google.redirect')) {
			return redirect()->route('signin')->withErrors(['email' => 'Login Google belum dikonfigurasi.']);
		}
		return Socialite::driver('google')->redirect();
	}

	public function handleProviderCallback(Request $request): RedirectResponse
	{
		if (!config('services.google.client_id') || !config('services.google.client_secret') || !config('services.google.redirect')) {
			return redirect()->route('signin')->withErrors(['email' => 'Login Google belum dikonfigurasi.']);
		}
		try {
			$user_google = Socialite::driver('google')->user();
			$user = User::where('email', $user_google->getEmail())->first();

			//jika user ada maka langsung di redirect ke halaman home
			//jika user tidak ada maka simpan ke database
			//$user_google menyimpan data google account seperti email, foto, dsb

			if ($user != null) :
				auth()->login($user, true);

				return redirect()->route('member.main');
			else :
				$create = User::Create([
					'email'             => $user_google->getEmail(),
					'name'              => $user_google->getName(),
					'password'          => Hash::make(Str::random(32)),
					'third_party'		=> 'google',
					'email_verified_at' => now()
				]);
				auth()->login($create, true);
				$package = Package::select('id', 'price')->where('id', 1)->first();
				$template = Template::select('id', 'preset', 'file')->where('slug', 'the-wedding')->first();
				$template->new_preset = json_decode($template->preset);
				$template->new_preset->cover->name->male = $user_google->getName();
				$template->new_preset->cover->name->female = $user_google->getName();
				$template->new_preset->profile->name->male = $user_google->getName();
				$template->new_preset->profile->name->female = $user_google->getName();
				$template->new_preset->rsvp->date = date('Y-m-d', strtotime('+3 days'));
				$template->new_preset->detail->calendar->date = date('Y-m-d', strtotime('+3 days'));
				$inv = Invitation::create([
					'title'		=> json_encode([$user_google->getName(), $user_google->getName()]),
					'slug'		=> clean_str($user_google->getName()).date('ymdh'),
					'file'		=> $template->file,
					'preset'	=> json_encode($template->new_preset),
					'user_id'	=> Auth::user()->id,
					'ip_addr'	=> $_SERVER['REMOTE_ADDR'],
					'template_id'	=> $template->id,
				]);
				$member = Account::create([
					'content'	=> json_encode(['phone'=>null, 'address'=>null]),
					'file'		=> $user_google->getAvatar(),
					'user_id'	=> Auth::user()->id,
					'ip_addr'	=> $_SERVER['REMOTE_ADDR'],
					'invitation_id'	=> $inv->id,
					'package_id'	=> $package->id,
				]);
				$invoice_column = [
					'date' => now(),
					'amount' => $package->price,
					'package_id'=> $package->id,
					'user_id'	=> Auth::user()->id,
					'ip_addr'	=> $_SERVER['REMOTE_ADDR'],
				];
				if ($package->price == 0) :
					$invoice_column['content'] = json_encode(['invoice_number'=>'#free']);
					$invoice_column['status'] = Str::upper('confirmed');
					$invoice_column['payment_link'] = '#';
					$invoice_column['payment_code'] = 'Free';
				endif;
				$invoice = AccountInvoice::create($invoice_column);

				return redirect()->route('member.main');
			endif;
		} catch (Exception $e) {
			return redirect()->to(route('signin').'?manual=1')->withErrors(['email' => 'Login Google gagal, silakan coba lagi.']);
		}
	}
}
