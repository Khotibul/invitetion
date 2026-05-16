<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()) :
            if (in_array(Auth::user()->role, ['member'])) :
                // Jika akun member dinonaktifkan oleh admin, paksa logout.
                if (Auth::user()->acc && (string) Auth::user()->acc->actived !== '1') {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('signin')->withErrors([
                        'email' => 'Akun kamu sedang non-aktif. Silakan hubungi admin.',
                    ]);
                }
                return $next($request);
            endif;
        else :
            return redirect()->route('signin');
        endif;

        return redirect()->route('signup');
    }
}
