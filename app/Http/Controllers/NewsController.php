<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function all_news(Request $request)
    {
        $all_news = News::orderBy('id','desc')->paginate(5);
        return view('layout.all_news', ['all_news' => $all_news]);
    }
}
