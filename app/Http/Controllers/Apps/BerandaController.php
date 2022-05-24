<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('app.index');
    }
}
