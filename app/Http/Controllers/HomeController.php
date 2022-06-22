<?php

namespace App\Http\Controllers;

use App\Models\Actividades;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function users()
    {
        return view('users');
    }

    public function calendar()
    {
        $actividades = Actividades::all();
        return response()->json($actividades);
    }
}
