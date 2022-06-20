<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterUsersController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view('administrador.users',['usuarios' => $usuarios]);
    }
}
