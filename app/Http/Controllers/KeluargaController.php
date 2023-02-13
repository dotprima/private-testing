<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeluargaController extends Controller
{

    public function index()
    {

        return view('keluarga');
    }

    public function anak()
    {

        return view('anak');
    }
}
