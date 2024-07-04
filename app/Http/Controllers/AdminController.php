<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function admin()
    {
        // if (Auth::check()) {
        //     echo "Halo, Selamat Datang di Halaman Admin";
        //     echo "<h1>" . Auth::user()->name . "</h1>";
        //     echo "<a href='/logout'>Logout</a>";
        // } else {
        //     return redirect('/login')->withErrors('Login Terlebih Dahulu.');
        // }
        return view('admin');
    }
    public function petugasgudang()
    {
        // if (Auth::check()) {
        //     echo "Halo, Selamat Datang di Halaman Petugas Gudang";
        //     echo "<h1>" . Auth::user()->name . "</h1>";
        //     echo "<a href='/logout'>Logout</a>";
        // } else {
        //     return redirect('/login')->withErrors('Login Terlebih Dahulu.');
        // }
        return view('pg');
    }
    public function kasir()
    {
        // if (Auth::check()) {
        //     echo "Halo, Selamat Datang di Halaman Kasir";
        //     echo "<h1>" . Auth::user()->name . "</h1>";
        //     echo "<a href='/logout'>Logout</a>";
        // } else {
        //     return redirect('/login')->withErrors('Login Terlebih Dahulu.');
        // }
        return view('kasir');
    }
}
