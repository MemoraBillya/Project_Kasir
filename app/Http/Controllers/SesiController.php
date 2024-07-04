<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\RedisCaster;
use Illuminate\Support\Facades\DB;

class SesiController extends Controller
{
    function index(){
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);
    
        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        // Cek apakah email ada di database
        $user = DB::table('users')->where('email', $infologin['email'])->first();
        
        if (!$user) {
            // Jika email tidak ada di database
            return redirect()->back()->withErrors('Username tidak terdaftar')->withInput();
        }
    
        // Jika email ada, coba autentikasi
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'admin') {
                return redirect('admin');
            } elseif (Auth::user()->role == 'petugasgudang') {
                return redirect('petugasgudang');
            } elseif (Auth::user()->role == 'kasir') {
                return redirect('kasir');
            }
        } else {
            // Jika autentikasi gagal, berarti password salah
            return redirect()->back()->withErrors('Password tidak sesuai')->withInput();
        }

    }
    function logout(){
        Auth::logout();
        return redirect('home');
    }
}