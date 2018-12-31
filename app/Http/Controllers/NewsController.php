<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_news = News::orderBy('id', 'desc')->paginate(5);
        $soft_deletes = News::onlyTrashed()->orderBy('id', 'asc')->get();
        $title = "News";
        return view('news.index', ['all_news' => $all_news, 'trashed' => $soft_deletes, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create or Add News";
        return view('news.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = [
            'title' => trans('admin.title'),
            'desc' => trans('admin.desc'),
            'content' => trans('admin.content'),
            'status' => trans('admin.status'),
        ];
        $data = $this->validate($request, [
            'title' => 'required',
            'desc' => 'required',
            'photo' => 'required|image',
            'content' => 'required',
            'status' => 'required',
        ], [], $attribute);
        $data['photo'] = $request->photo->store('image');
        $data['user_id'] = auth()->user()->id;
        News::create($data);
        session()->flash('success', 'News Added Successfully');
        return redirect('news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
