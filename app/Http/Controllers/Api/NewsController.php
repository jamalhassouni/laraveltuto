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

}
