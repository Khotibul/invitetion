<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(): Response
    {
        // Cache template list 10 menit — data jarang berubah
        $templates = Cache::remember('landing_templates', 600, function () {
            return Template::select('title', 'slug', 'file', 'grade')
                ->publish()
                ->orderBy('grade')
                ->get();
        });

        // Ambil paket dari database (cache 10 menit)
        $packages = Cache::remember('landing_packages', 600, function () {
            return Package::select('id', 'title', 'slug', 'price', 'grade', 'content')
                ->publish()
                ->orderBy('grade')
                ->get()
                ->map(function ($p) {
                    $content = json_decode($p->content ?? '{}', true);
                    $p->price_formatted = $p->price == 0
                        ? 'Gratis'
                        : 'Rp ' . number_format((int)$p->price, 0, ',', '.');
                    $p->features = [
                        'template'      => $content['template']      ?? ['basic'],
                        'active'        => $content['active']        ?? 0,
                        'guest'         => $content['guest']         ?? 0,
                        'gallery_photo' => $content['gallery-photo'] ?? 0,
                        'story'         => $content['story']         ?? false,
                        'gift'          => $content['gift']          ?? false,
                        'e_invitation'  => $content['e-invitation']  ?? false,
                        'live_stream'   => $content['live-stream']   ?? false,
                        'smart_wa'      => $content['smart-wa']      ?? false,
                    ];
                    return $p;
                });
        });

        $data = [
            'title'     => 'dashboard',
            'templates' => $templates,
            'packages'  => $packages,
        ];

        $response = response()->view('welcome-green', compact('data'));
        $response->header('Cache-Control', 'public, max-age=600, stale-while-revalidate=120');

        return $response;
    }

    public function info(string $slug): Response
    {
        return response()->view('info');
    }
}
