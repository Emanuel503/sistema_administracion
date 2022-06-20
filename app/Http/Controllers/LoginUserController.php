<?php

namespace App\Http\Controllers;

class LoginUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('solouser',['only'=> ['index']]);
    }
    
    public function index()
    {
        return view('usuario.home');
    }
}
