<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class navbarController extends Controller
{
    public function index(){
        $user = Auth::user()->role;
        return view('layouts.navbars.auth.sidebar', compact('user'));
}
}