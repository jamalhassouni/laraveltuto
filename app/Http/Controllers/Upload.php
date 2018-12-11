<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class Upload extends Controller
{
    public function upload()
    {
        $niceNames = [];
        $i = 0;
        foreach (request()->file('file') as $file) {
            $niceNames['file.' . $i] = ' File (' . ($i + 1) . ')';
            $i++;
        }
        $this->validate(request(), ['file.*' => 'required|image|mimes:jpg,jpeg,png'], [], $niceNames);
        $files = request()->file('file');
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getClientSize();
            $type = $file->getClientMimeType();
            $realPath = $file->getRealPath();
            $file->move(public_path('uploads'), 'image_' . time() . '.' . $ext);
        }
        return back();
    }
}
