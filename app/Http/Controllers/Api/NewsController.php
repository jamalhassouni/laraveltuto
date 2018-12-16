<?php

namespace App\Http\Controllers\Api;

use App\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\Rules\CheckExistNews;
use Validator;

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
        $comments = $news->comments()->orderBy('id', 'desc')->paginate(1);
        return !empty($news) ? response(['status' => true, compact('news', 'comments')]) : response(['status' => false]);
    }

    public function add_comment(Request $request)
    {
        $rules = [
            'comment' => 'required',
            'news_id' => ['required', 'numeric', new CheckExistNews],
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => false, 'messages' => $validate->messages()]);
        } else {
            $addComment = New Comments;
            $addComment->user_id = auth()->user()->id;
            $addComment->news_id = $request->input('news_id');
            $addComment->comment = $request->input('comment');
            $addComment->save();
            return response(['status' => true, 'message' => 'The comment was added successfully']);
        }
    }
}
