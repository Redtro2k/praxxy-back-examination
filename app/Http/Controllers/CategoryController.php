<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function __construct(Category $category){
        return $this->category = $category;
    }
    public function index($id = null){
        $categories = $this->category->all()->map(fn($m) => [
            'id' => $m->id,
            'title' => $m->title,
            'items' => $m->product()->count()
        ]);
        return Inertia::render("Category/CategoryIndex", [
            'categories' => $categories,
            'category' => !!$id ? $this->category->findOrFail($id) : null
        ]);
    }
}
