<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class Upload extends Controller
{
    public function upload()
    {
        $this->validate(request(), ['file' => 'required|image|mimes:jpg,jpeg,png']);
        $file = request()->file('file');
        //$name =   $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        //$size = $file->getClientSize();
        // $type = $file->getClientMimeType();
        // $realPath = $file->getRealPath();
        return $file->move(public_path('uploads'), 'image_' . time() . '.' . $ext);
    }
}
