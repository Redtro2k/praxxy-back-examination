<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class VideoController extends Controller
{
    //
    public function index(){
        $videos = collect([
            ['id' => 1, 'url' => 'jujutsu.mp4']
        ]);
        
        return Inertia::render('Videos/VideoShow', [
            'videos' => $videos
        ]);
    }
}
