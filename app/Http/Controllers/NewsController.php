<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function test(Request $request)
    {
        $action = $request->input('action');
        $myName = 'Jamal Hassouni';
        return view('layout.test', compact('action', 'myName'));
    }
}
