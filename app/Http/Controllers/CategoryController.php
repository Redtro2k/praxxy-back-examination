<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
use App\Events\{CategoryCreated, CategoryRemoved};
use Illuminate\Support\Facades\Session;

use App\Models\Product;

class CategoryController extends Controller
{
    public function __construct(Category $category){
        return $this->category = $category;
    }
    public function index($id = null){
        $categories = $this->category->all()->map(fn($m) => [
            'id' => $m->id,
            'title' => $m->title,
            'items' => $m->product()->whereDate('created_at', '>', Carbon::now()->subDay())->count(),
        ]);
        Session::forget('success');
        return Inertia::render("Category/CategoryIndex", [
            'categories' => $categories,
            'category' => !!$id ? $this->category->findOrFail($id) : null,
            'new_items' => $this->category->whereDate('created_at', '>', Carbon::now()->subHour())->count(),
            'pusher_credentials' => collect([
                'api_key' => env('PUSHER_APP_KEY'),
                'cluster' => env('PUSHER_APP_CLUSTER')
            ])
        ]);
    }
    public function store(CategoryRequest $request){
        if(!$request->validated()){
            return abort(500);
        }else{
            $add_category = $this->category->create(['title' => $request->title]);
            $getMessage = collect([
                'flash' => 'success',
                'text' => 'New Category has been Created. please reload this page.'
            ]);
            broadcast(new CategoryCreated($getMessage));
            return redirect()->route('category.index')->with('success', 'Successfully Create New Category');
        }
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
    public function destroy($id){
        $get_product = Product::where('category_id', $id)->get();
        if($get_product->count() != 0){
            $get_product->each->delete();
        }
        $this->category->find($id)->delete();
        return redirect()->back()->with('success', 'successfully deleted One Category');
    }
}
