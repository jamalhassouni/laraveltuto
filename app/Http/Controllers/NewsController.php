<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function all_news(Request $request)
    {
        $all_news = News::orderBy('id', 'desc')->paginate(5);
        return view('layout.all_news', ['all_news' => $all_news]);
    }

    public function insert_news()
    {
        $add = new News();
        $add->title = \request('title');
        $add->desc = \request('desc');
        $add->content = \request('content');
        $add->add_by = \request('add_by');
        $add->status = \request('status');
        $add->save();
        return back();
    }
}
