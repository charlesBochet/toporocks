<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function postUpload(PictureRequest $request)
    {
        $path = Storage::disk('s3')->put('images', $request->file);
        return response(['path' => $path]);
    }
}
