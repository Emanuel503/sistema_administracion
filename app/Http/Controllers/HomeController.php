<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('soloadmin',['only'=> ['index']]);
    }
    
    public function index()
    {
        return view('administrador.home');
    }
}
