<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function ktp($name)
    {
        $storagePath = public_path('/uploads/ktp/'.$name);

        return response()->file($storagePath);
    }

    public function pas_foto($name)
    {
        $storagePath = public_path('/uploads/pas_foto/'.$name);

        return response()->file($storagePath);
    }
}
