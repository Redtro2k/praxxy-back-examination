<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
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
    public function update(CategoryRequest $request, $id){
        if($request->validated()){
            $category = $this->category->find($id);
            $category->update([
                'title' => $request->title
            ]);
            return redirect()->route('category.index')->with('success', 'Successfully update this category');
        }else{
            return abourt(419);
        }
    }
}
