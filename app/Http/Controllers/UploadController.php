<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function __invoke($id, Request $request){
        return $request->hasFile('image');
    }
}
