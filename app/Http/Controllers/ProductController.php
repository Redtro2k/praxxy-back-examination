<?php

namespace App\Http\Controllers;

 use Inertia\Inertia;
use App\Models\{Category, Product};
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index(){
        $get_product = $this->product->paginate(5)->through(fn($p) => [
            'id' => $p->id,
            'title' => $p->title,
            'category' => $p->category->title,
            'excerpt' => $p->excerpt,
            'date_created' => $p->created_at,
            'date_modified' => $p->updated_at
        ]);
        return Inertia::render('Product/ProductIndex', [
            'products' => $get_product
        ]);
    }

    public function create(){
        $category = Category::all()->map(fn($c) => [
            'id' => $c->id,
            'name' => $c->title
        ]);
        return Inertia::render('Product/ProductCreate', [
            'categories' => $category
        ]);
    }

    public function store(ProductRequest $request){
        if($request->validated()){
            $this->product->create([
                'title' => $request->title,
                'category_id' => $request->category,
                'description' => $request->description
            ]);
            return redirect()->route('product.index')->with('success', 'New product created successfully!');        
        }else{
            return abort(405);
        }
    }

    public function show($id){
        $product = $this->product->find($id);
        if (!$product) {
            return abort(404);
        }else{
            $productData = [
                'id' => $product->id,
                'title' => $product->title,
                'category' => $product->category->title,
                'description' => $product->description,
                'date_created' => $product->created_at,
                'date_modified' => $product->updated_at
            ];
            return Inertia::render('Product/ProductShow', [
                'product' => $productData
            ]);
        }
    }

    public function revert(Request $request){
        $fileId = request()->getContent();
    }
}
