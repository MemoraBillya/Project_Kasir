<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }
        
        Auth::logout();
        return redirect('/login')->withErrors('Anda Tidak Memiliki Akses ke Page Tersebut. Login Kembali.');
    }
}
//     public function handle(Request $request, Closure $next, $role)
//     {
//         if (auth()->user()->role == $role) {
//             return $next($request);
//         }
        
//         return redirect('login')->withErrors('Anda Tidak Punya Akses. Login kembali');
//     }
// }
