<?php

namespace App\Providers;

use App\Models\AccountInvoice;
use App\Models\Contact;
use App\Models\LinkExternal;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (config('database.default') === 'pgsql') {
            $this->app->bind('db.connector.pgsql', \App\Database\NeonPostgresConnector::class);
        }
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Paginator::useBootstrap();

        if (!Schema::hasTable('settings')) {
            View::share('global', $this->emptyGlobal());
            return;
        }

        $global = Cache::remember('global_view_data', 300, function () {
            if (!Schema::hasTable('contacts') || !Schema::hasTable('link_externals')) {
                return $this->emptyGlobal();
            }

            return [
                'setting' => Setting::select('title', 'content')->get(),
                'contact' => [
                    Contact::select('title', 'content')->whereType('address')->whereActived('1')
                        ->firstOr(fn () => (object) ['title' => null, 'content' => null]),
                    Contact::select('title', 'content')->whereType('map')->whereActived('1')
                        ->firstOr(fn () => (object) ['title' => null, 'content' => 'no-map']),
                    Contact::select('title', 'content')->whereType('email')->whereActived('1')->get(),
                    Contact::select('title', 'content')->whereType('phone')->whereActived('1')->get(),
                    Contact::select('title', 'content')->whereType('whatsapp')->whereActived('1')->get(),
                ],
                'social' => LinkExternal::select('brand', 'title', 'url', 'icon')
                    ->whereType('social')->whereActived('1')->get(),
            ];
        });

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
                (object) ['title' => null, 'content' => null],
                (object) ['title' => null, 'content' => 'no-map'],
                collect([]),
                collect([]),
                collect([]),
            ],
            'social' => collect([]),
            'admin' => ['payment_waiting' => 0],
        ];
    }
}
