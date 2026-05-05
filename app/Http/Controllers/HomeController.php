<?php

namespace App\Http\Controllers;

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

        $data = [
            'title'     => 'dashboard',
            'templates' => $templates,
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
