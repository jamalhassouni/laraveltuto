<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    public function all_news()
    {
        $all_news = News::withCount('comments_count')->orderBy('id', 'desc')->paginate(10);
        return response(['all_news' => $all_news]);
    }

    public function news($id)
    {
        $news = News::find($id);
        $comments = $news->comments()->orderBy('id','desc')->paginate(1);
        return !empty($news) ? response(['status' => true, compact('news', 'comments')]) : response(['status' => false]);
    }

}
