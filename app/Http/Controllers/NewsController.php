<?php

namespace App\Http\Controllers;

use App\File;
use App\News;
use Illuminate\Http\Request;

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
        $rules = [
            'title' => 'required',
            'desc' => 'required',
            'photo' => 'required|image',
            'files.*' => 'image',
            'content' => 'required',
            'status' => 'required',
        ];
        $data = $this->validate($request, $rules, [], $attribute);
        $tempFolder = time();
        $data['photo'] = $request->photo->store('image/' . $tempFolder);
        $data['user_id'] = auth()->user()->id;
        $news = News::create($data);
        foreach ($request->file('files') as $file) {
            \Storage::makeDirectory('image/' . $news->id);
            $uploadFile = $file->store('image/' . $news->id);
            File::create([
                'user_id' => auth()->user()->id,
                'news_id' => $news->id,
                'path' => 'image/' . $news->id,
                'file' => $uploadFile,
                'size' => \Storage::size($uploadFile),
                'file_name' => $file->getClientOriginalName(),

            ]);
        }
        $newName = str_replace($tempFolder, $news->id, $news['photo']);

        \Storage::rename($news['photo'], $newName);
        News::where('id', $news->id)->update(['photo' => $newName]); // Move Or Rename Temp folder and Save it
        \Storage::deleteDirectory('image/' . $tempFolder); // delete directory temp
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
        $news = News::find($id);

        return view('news.show', ['news' => $news]);
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
    public function destroy($id = null)
    {
        if ($id != null) {
            News::find($id)->delete();

            \Storage::deleteDirectory('image/' . $id); // delete directory temp
            session()->flash('success', 'News Deleted Successfully');
        }
        return redirect('news');

    }
}
