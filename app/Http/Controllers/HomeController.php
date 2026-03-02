<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): Response
    {
        $data = [
            'title' => 'dashboard',
            'templates' => Template::select('title', 'slug', 'file', 'grade')->publish()->get()
        ];

        return response()->view('welcome-green', compact('data'));
    }

    public function info(string $slug): Response
	{
		return response()->view('info');
	}
}
