<?php

namespace App\Http\Controllers;

use App\Models\Lugares;
use Illuminate\Http\Request;

class LugaresController extends Controller
{
    public function index(){
        $lugares = Lugares::all();
        return view('lugares', ['lugares' => $lugares]);
    }
}