<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('Inertia/Index');
    }
    public function show($id)
    {
        //ddを使うとモーダルで確認できる
        // dd($id);
        return Inertia::render('Inertia/Show',
        [
            'id' => $id
        ]);
    }
}
