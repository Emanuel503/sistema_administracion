<?php

namespace App\Http\Controllers;

class LoginAdminController extends Controller
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
