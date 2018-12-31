<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Comments;

class NewsControllerOld extends Controller
{

    public function index()
    {
        $all_news = News::orderBy('id', 'desc')->paginate(5);
        $soft_deletes = News::onlyTrashed()->orderBy('id', 'asc')->get();
        return view('news.index', ['all_news' => $all_news, 'trashed' => $soft_deletes]);

    }

    public function add()
    {
        return view('news.add');
    }

    public function Add_comment($news_id)
    {
        $data = $this->validate(\request(), [
            'comment' => 'required',
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['news_id'] = $news_id;
        Comments::create($data);
        return back();
    }

    public function show($id)
    {
        $news = News::find($id);

        return view('news.show', ['news' => $news]);

    }

    public function insert_news(Request $request)
    {
        if ($request->ajax()) {

            $attribute = [
                'title' => trans('admin.title'),
                'desc' => trans('admin.desc'),
                'content' => trans('admin.content'),
                'user_id' => trans('admin.add_by'),
                'status' => trans('admin.status'),
            ];
            $data = $this->validate(\request(), [
                'title' => 'required',
                'desc' => 'required',
                'content' => 'required',
                'user_id' => 'required',
                'status' => 'required',
            ], [], $attribute);
            $news = News::create($data);
            $html = view('news.row_news', ['news' => $news])->render();
            return response(['status' => true, 'result' => $html]);

        }
        //  session()->flash('message', 'News Record Added successfully'); // value
        /*session()->put(); // value
        session()->push(); // session array
        session()->flash(); //
         */
        return back();
    }

    public function delete($id = null)
    {
        if ($id != null) {
            $delete = News::find($id);
            $delete->delete();
        } elseif (\request()->has('restore') and \request()->has('id')) {
            News::whereIn('id', \request('id'))->restore();
        } elseif (\request()->has('forceDelete') and \request()->has('id')) {
            News::whereIn('id', \request('id'))->forceDelete(\request('id'));
        } elseif (\request()->has('delete') and \request()->has('id')) {
            News::destroy(\request('id'));
        }

        return redirect('news');
    }
}
