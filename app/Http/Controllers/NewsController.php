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
        $data = $this->validate(\request(),[
            'title' => 'required',
            'desc' => 'required',
            'content' => 'required',
            'add_by' => 'required',
            'status' => 'required',
        ]);
       // if($data)
         /*$add = new News();
        $add->title = \request('title');
        $add->desc = \request('desc');
        $add->content = \request('content');
        $add->add_by = \request('add_by');
        $add->status = \request('status');
        $add->save();*/
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
