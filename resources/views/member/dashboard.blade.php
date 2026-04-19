@extends('member.layouts.app')
@section('title', Str::title('dashboard'))
@php
	use Carbon\Carbon;
    $invoice = Auth::user()->invoice->first();
    if ($invoice) {
        $activation = $invoice->date;
        $packContent = ($invoice->pack && $invoice->pack->content) ? json_decode($invoice->pack->content) : null;
        $active = $packContent->active ?? 0;
        $template = $packContent->template ?? [];
        $packTitle = $invoice->pack ? $invoice->pack->title : 'Paket Tidak Diketahui';
    } else {
        $activation = now();
        $active = 0;
        $template = [];
        $packTitle = 'Belum Langganan';
    }
@endphp
@section('content')
<section class="py-3">
    <ul class="nav nav-pills creasik-nav-pill mb-3">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">
                <i class="bx bxs-widget"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="bx bx-user-circle"></i>
                <span>Profil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('packages') }}">
                <i class="bx bx-cart-alt"></i>
                <span>Pesan Undangan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('storage') }}">
                <i class="bx bx-images"></i>
                <span>Penyimpanan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaction') }}">
                <i class="bx bx-receipt"></i>
                <span>Transaksi</span>
            </a>
        </li>
    </ul>
    <div class="row flex-lg-row-reverse g-3 mb-3">
        <div class="col-12 col-lg-3">
            <div class="package-book bg-white shadow-sm rounded text-center p-2 mb-3">
                <span>Paket</span>
                <b class="text-creasik-primary">{{ $packTitle }}</b>
                @if (isexpired($activation, $active)===false)
                <span class="text-muted">
                    Aktif
                    @if (Carbon::parse($activation)->addDays($active)->diffInDays() <= 1)
                    {{ Carbon::parse($activation)->locale('id')->addDays($active)->diffForHumans() }}
                    @else
                    sampai
                    {{ Carbon::parse($activation)->locale('id')->addDays($active)->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}
                    @endif
                </span>
                @elseif (isexpired($activation, $active)===true)
                <span class="text-danger">Undangan telah kadaluwarsa.</span>
                @endif
                <a href="{{ route('packages') }}" class="bg-success text-white text-uppercase rounded w-100">
                    <i class="bx bx-chevrons-up"></i>
                    <span>upgrade</span>
                </a>
            </div>
            <div class="guest-book rounded p-2 {{ (Auth::user()->acc && Auth::user()->acc->guestbook==0) ? 'lock' : null }}">
                <a href="{{ route('guestbook') }}">
                    <img src="{{ url('images/icons/open-book_2702134.png') }}" alt="guestbook">
                    <span>Buku tamu</span>
                </a>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="row g-3">
                <div class="col-lg-7">
                    <div class="dashboard-summary bg-white shadow-sm rounded">
                        <h4>{{ $data->name }}</h4>
                        @if($data->subdomain)
                        <h6><a href="{{ route('invitation.index', $data->subdomain) }}" target="_BLANK">{{ route('invitation.index', $data->subdomain) }}</a></h6>
                        @else
                        <h6 class="text-muted">Belum ada link undangan</h6>
                        @endif
                        @if(Auth::user()->inv && Auth::user()->inv->file)
                        <img src="{{ url('storage/'.Auth::user()->inv->file) }}" alt="">
                        @else
                        <div class="bg-light p-5 text-center text-muted mb-3">Belum ada foto</div>
                        @endif
                        
                        @if($data->date)
                        <div id="countdown" class="countdown" data-time="{{ date('Y-m-d', strtotime($data->date->date)) }}">
                            <ul class="list-unstyled mb-0">
                                <li><b id="days">0</b><span>Hari</span></li>
                                <li><b id="hours">0</b><span>Jam</span></li>
                                <li><b id="minutes">0</b><span>Menit</span></li>
                                <li><b id="seconds">0</b><span>Detik</span></li>
                            </ul>
                        </div>
                        @endif
                        @if($data->subdomain)
                        <div class="text-center py-2">
                            <a href="{{ route('invitation.index', $data->subdomain) }}" class="btn btn-sm btn-creasik-primary me-1" target="_BLANK">
                                <i class="bx bx-link-external"></i>
                                <span>Tinjau</span>
                            </a>
                            <a href="{{ route('menu.detail') }}" class="btn btn-sm btn-creasik-primary">
                                <i class="bx bx-edit"></i>
                                <span>Ubah tanggal</span>
                            </a>
                        </div>
                        @endif
                    </div>
                    @if (!in_array($data->template, $template))
                    <div class="bg-warning rounded shadow p-3 mt-1">
                        <i class="bx bx-error"></i>
                        Kamu menggunakan template <b>{{ Str::title($data->template) }}</b>.
                    </div>
                    @endif
                </div>
                <div class="col-lg-5">
                    <div class="bg-white shadow-sm rounded p-3 {{ (Auth::user()->acc && Auth::user()->acc->guestbook==0) ? 'lock' : null }}">
                        <h4>Statistik</h4>
                        @php
                            use App\Models\Feedback;
                            $invId = Auth::user()->inv?->id;
                            $statHadir = $invId ? Feedback::where('invitation_id', $invId)->where('type', 'present')
                                ->whereRaw("content::text LIKE '%\"option\":\"yes\"%' OR content::text LIKE '%\"option\":\"hadir\"%'")
                                ->count() : 0;
                            $statTidak = $invId ? Feedback::where('invitation_id', $invId)->where('type', 'present')
                                ->whereRaw("content::text NOT LIKE '%\"option\":\"yes\"%' AND content::text NOT LIKE '%\"option\":\"hadir\"%'")
                                ->count() : 0;
                            $statTotal = $statHadir + $statTidak;
                        @endphp
                        <div class="d-flex justify-content-between">
                            <div class="progress" data-max="{{ max(1, $statTotal) }}" data-value="{{ $statHadir }}"></div>
                            <div class="progress-summary p-2">
                                <div>
                                    <span>Hadir</span>
                                    <b>{{ $statHadir }}</b>
                                </div>
                                <div>
                                    <span>Tidak hadir</span>
                                    <b>{{ $statTidak }}</b>
                                </div>
                            </div>
                        </div>
                        @if($statTotal > 0)
                        <div class="text-center mt-2">
                            <small class="text-muted">{{ $statTotal }} konfirmasi kehadiran</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="preset-menu grid-5">
        @foreach ($menu as $item)
        @php
        $lock = [];
        // lock by guestbook
        if (in_array($item['id'], ['reservation', 'table-management', 'souvenir'])) :
            if (Auth::user()->acc && Auth::user()->acc->guestbook==1) :
                $lock[$item['id']] = false;
                $item['url'] = $item['url'];
            elseif (Auth::user()->acc && Auth::user()->acc->guestbook==0) :
                $lock[$item['id']] = true;
                $item['url'] = 'packages';
            else:
                 // Default if acc is missing or guestbook status unknown
                $lock[$item['id']] = true;
                $item['url'] = 'packages';
            endif;
        else :
            $lock[$item['id']] = false;
        endif;
        // **

        // lock by package
        if (in_array($item['id'], array_keys($conditional))) :
            $lock[$item['id']] = ($conditional[$item['id']]===false) ? true : false;
            $item['url'] = ($conditional[$item['id']]===false) ? 'packages' : $item['url'];
        endif;
        // **
        @endphp
        <a href="{{ route($item['url']) }}" @class(['shadow-sm', 'rounded', 'p-3', 'lock' => $lock[$item['id']]])>
            <img src="{{ url('images/icons/'.$item['icon']) }}" alt="{{ $item['title'] }}">
            <span>{{ Str::upper($item['title']) }}</span>
        </a>
        @endforeach
    </div>

    <div class="mt-4">
        <h4 class="mb-3">Template Undangan</h4>
        <div class="bg-white shadow-sm rounded p-3">
            <div class="row g-3">
                @foreach (['basic', 'premium', 'exclusive'] as $grade)
                    @if (isset($data->templates->$grade))
                        <div class="col-12">
                            <h5 class="text-muted text-capitalize">{{ $grade }}</h5>
                            <div class="d-flex flex-nowrap overflow-auto pb-2" style="gap: 15px;">
                                @foreach ($data->templates->$grade as $item)
                                    <div class="card shadow-sm border-0" style="min-width: 200px; max-width: 200px;">
                                        <div class="position-relative">
                                            <img src="{{ Str::startsWith($item->file, 'template/') ? asset($item->file) : url('storage/'.$item->file) }}" class="card-img-top rounded" alt="{{ $item->title }}" style="height: 150px; object-fit: cover;">
                                            @if (Auth::user()->inv && Auth::user()->inv->temp && $item->id == Auth::user()->inv->temp->id)
                                                <span class="badge bg-warning position-absolute top-0 end-0 m-2">Aktif</span>
                                            @endif
                                        </div>
                                        <div class="card-body p-2 text-center">
                                            <h6 class="card-title mb-2 text-truncate" title="{{ $item->title }}">{{ $item->title }}</h6>
                                            <div class="d-grid gap-1">
                                                <a href="{{ route('preview-template.index', $item->slug) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                    <i class="bx bx-show"></i> Tinjau
                                                </a>
                                                @if (Auth::user()->inv && Auth::user()->inv->temp && $item->id != Auth::user()->inv->temp->id)
                                                    <form action="{{ route('save.setting', 'design') }}" class="save-menu d-grid" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="design_template" value="{{ $item->id }}">
                                                        {{-- Fields required by controller validation --}}
                                                        @php
                                                            $preset = Auth::user()->inv->preset ? json_decode(Auth::user()->inv->preset) : null;
                                                            $design = $preset ? $preset->design : null;
                                                        @endphp
                                                        @if($design)
                                                        <input type="hidden" name="design_title_color" value="{{ $design->title->color ?? '#000000' }}">
                                                        <input type="hidden" name="design_content_color" value="{{ $design->content->color ?? '#000000' }}">
                                                        <input type="hidden" name="design_background" value="{{ $design->background ?? '#ffffff' }}">
                                                        <input type="hidden" name="design_button_background" value="{{ $design->button->background ?? '#ffffff' }}">
                                                        <input type="hidden" name="design_button_color" value="{{ $design->button->color ?? '#000000' }}">
                                                        <input type="hidden" name="design_title_font" value="{{ $design->title->font ?? 'Arial' }}">
                                                        <input type="hidden" name="design_content_font" value="{{ $design->content->font ?? 'Arial' }}">
                                                        
                                                        <button type="submit" class="btn btn-sm btn-creasik-primary">
                                                            <i class="bx bx-check"></i> Gunakan
                                                        </button>
                                                        @endif
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
if ($("#countdown").length > 0) {
    (function () {
        const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
        let thetime = document.getElementById('countdown').getAttribute('data-time'),
            dateString = thetime+"T09:00:00+0000",
            dateStringISO = dateString.replace(/([+\-]\d\d)(\d\d)$/, "$1:$2");
        const countDown = new Date(dateStringISO).getTime(),
        x = setInterval(function() {
            const now = new Date().getTime(),
            distance = countDown - now;
            document.getElementById("days").innerText = Math.floor(distance / (day)),
            document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
            document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
            document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
            //do something later when date is reached
            if (distance < 0) {
                document.getElementById("countdown").innerText = `Acara telah selesai`;
                clearInterval(x);
            }
            // console.log(now);
        }, 0);
    }());
}
</script>
@endpush
