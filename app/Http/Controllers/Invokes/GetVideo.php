<?php

namespace App\Http\Controllers\Invokes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class GetVideo extends Controller
{
    public function __invoke($video){
        $file = Storage::disk('public')->get("Videos/{$video}");
        $response = Response::make($file, 200);
        $response->header('Content-type', "Video/mp4");
        return $response;
    }
}
