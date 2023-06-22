<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    //
    public function create(){
        return Inertia::render("Category/CategoryCreate");
    }
}
