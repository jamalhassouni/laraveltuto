<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function all_news(Request $request)
    {
        $all_news = News::orderBy('id', 'desc')->paginate(5);
        $soft_deletes = News::onlyTrashed()->orderBy('id', 'asc')->get();
        return view('layout.all_news', ['all_news' => $all_news, 'trashed' => $soft_deletes]);
    }

    public function insert_news()
    {
        $attribute = [
            'title' => trans('admin.title'),
            'desc' => trans('admin.desc'),
            'content' => trans('admin.content'),
            'add_by' => trans('admin.add_by'),
            'status' => trans('admin.status'),
        ];
        $data = $this->validate(\request(), [
            'title' => 'required',
            'desc' => 'required',
            'content' => 'required',
            'add_by' => 'required',
            'status' => 'required',
        ], [], $attribute);
        News::create($data);
        session()->flash('message', 'News Record Added successfully'); // value
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

        return redirect('all/news');
    }
}
