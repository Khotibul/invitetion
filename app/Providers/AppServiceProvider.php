<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Setting;
use App\Models\LinkExternal;
use App\Models\AccountInvoice;
use App\Database\NeonPostgresConnector;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
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

        // ── Cloudflare R2 override dihapus — pakai public disk saja

        // ── Guard: jika tabel belum ada (fresh install / migration belum jalan)
        if (!Schema::hasTable('settings')) {
            View::share('global', $this->emptyGlobal());
            return;
        }

        // ── Share global data ke semua view
        // Cache 5 menit untuk data statis (setting, contact, social)
        // payment_waiting tidak di-cache karena harus real-time
        $global = Cache::remember('global_view_data', 300, function () {
            if (!Schema::hasTable('contacts') || !Schema::hasTable('link_externals')) {
                return $this->emptyGlobal();
            }

            return [
                'setting' => Setting::select('title', 'content')->get(),
                'contact' => [
                    Contact::select('title', 'content')->whereType('address')->whereActived('1')
                        ->firstOr(fn() => (object)['title' => null, 'content' => null]),
                    Contact::select('title', 'content')->whereType('map')->whereActived('1')
                        ->firstOr(fn() => (object)['title' => null, 'content' => 'no-map']),
                    Contact::select('title', 'content')->whereType('email')->whereActived('1')->get(),
                    Contact::select('title', 'content')->whereType('phone')->whereActived('1')->get(),
                    Contact::select('title', 'content')->whereType('whatsapp')->whereActived('1')->get(),
                ],
                'social' => LinkExternal::select('brand', 'title', 'url', 'icon')
                    ->whereType('social')->whereActived('1')->get(),
            ];
        });

        // payment_waiting selalu fresh (admin badge)
        $paymentWaiting = Schema::hasTable('account_invoices')
            ? AccountInvoice::whereStatus('PENDING')->count()
            : 0;

        View::share('global', array_merge($global, [
            'admin' => ['payment_waiting' => $paymentWaiting],
        ]));
    }

    private function emptyGlobal(): array
    {
        return [
            'setting' => collect([]),
            'contact' => [
                (object)['title' => null, 'content' => null],
                (object)['title' => null, 'content' => 'no-map'],
                collect([]), collect([]), collect([]),
            ],
            'social' => collect([]),
            'admin'  => ['payment_waiting' => 0],
        ];
    }
}
