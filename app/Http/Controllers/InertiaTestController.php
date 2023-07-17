<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\InertiaTest;

class InertiaTestController extends Controller
{
    public function index()
    {
        // return Inertia::render('Inertia/Index');
        return Inertia::render('Inertia/Index', [
            'blogs' => InertiaTest::all()
        ]);
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

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:20'], 
            'content' => ['required'],
        ]);

        $inertiaTest = new InertiaTest; 
        $inertiaTest->title = $request->title; 
        $inertiaTest->content = $request->content; 
        $inertiaTest->save();
        
        return to_route('inertia.index')->with([
            'message' => '登録しました。' 
        ]);
    }
    
    public function create() 
    {
        return Inertia::render('Inertia/Create'); 
    }
}
