<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Setting;
use App\Models\LinkExternal;
use App\Models\AccountInvoice;
use App\Database\NeonPostgresConnector;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register custom Neon PostgreSQL connector (SNI fix untuk libpq lama)
        $this->app->bind('db.connector.pgsql', NeonPostgresConnector::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // ── Cloudflare R2: jika FILESYSTEM_DISK=r2, override disk 'public'
        // agar semua Storage::disk('public') otomatis pakai R2
        if (config('filesystems.default') === 'r2') {
            config(['filesystems.disks.public' => array_merge(
                config('filesystems.disks.r2', []),
                ['url' => config('filesystems.disks.r2.url', '')]
            )]);
        }

        if (!Schema::hasTable('contacts') || !Schema::hasTable('settings') || !Schema::hasTable('link_externals') || !Schema::hasTable('account_invoices')) {
            View::share('global', [
                'setting' => collect([]),
                'contact' => [
                    json_decode(json_encode(['title' => null, 'content' => null]), false),
                    json_decode(json_encode(['title' => null, 'content' => 'no-map']), false),
                    collect([]), collect([]), collect([]),
                ],
                'social' => collect([]),
                'admin'  => ['payment_waiting' => 0],
            ]);
            return;
        }

        $address  = Contact::select('title', 'content')->whereType('address')->whereActived('1')->firstOr(fn() => json_decode(json_encode(['title' => null, 'content' => null]), false));
        $map      = Contact::select('title', 'content')->whereType('map')->whereActived('1')->firstOr(fn() => json_decode(json_encode(['title' => null, 'content' => 'no-map']), false));
        $email    = Contact::select('title', 'content')->whereType('email')->whereActived('1')->get();
        $phone    = Contact::select('title', 'content')->whereType('phone')->whereActived('1')->get();
        $whatsapp = Contact::select('title', 'content')->whereType('whatsapp')->whereActived('1')->get();
        $social   = LinkExternal::select('brand', 'title', 'url', 'icon')->whereType('social')->whereActived('1')->get();
        $setting  = Setting::select('title', 'content')->get();
        $payment_waiting = AccountInvoice::whereStatus('PENDING')->count();

        View::share('global', [
            'setting' => $setting,
            'contact' => [$address, $map, $email, $phone, $whatsapp],
            'social'  => $social,
            'admin'   => ['payment_waiting' => $payment_waiting],
        ]);
    }
}
