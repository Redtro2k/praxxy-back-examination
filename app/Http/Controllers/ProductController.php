<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;

class ProductController extends Controller
{
    //
    public function create(){
        $category = Category::all()->map(fn($c) => [
            'id' => $c->id,
            'name' => $c->title
        ]);
        return Inertia::render('Product/ProductCreate', [
            'categories' => $category
        ]);
    }
}
