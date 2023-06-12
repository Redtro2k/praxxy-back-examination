<?php

namespace App\Http\Controllers;

 use Inertia\Inertia;
use App\Models\{Category, Product};
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    public function __construct(Product $product){
        $this->product = $product;
    }
    //i hope you its qualified search function inside the my index hehehe
    public function index(){
        // Get the search and category parameters from the request
        $search = Request::input('search');
        $category = Request::input('category');
        $get_category = Category::where('title', $category)->first();

        // Start building the product query
        $products = $this->product->where(function($query) use($search){
        $query->where('title', 'LIKE', '%' . $search . '%')->orWhere('description', 'LIKE', '%' . $search . '%');
        });

        // Add a condition to filter by category if provided
        if (!empty($category)) {
            $products->whereHas('category', function($query) use ($get_category) {
                $query->where('category_id', $get_category->id);
            });
        }

        // Paginate the results and transform each product using a callback function
        $products = $products->paginate(5)->through(fn($p) => [
            'id' => $p->id,
            'title' => $p->title,
            'category' => $p->category->title,
            'excerpt' => $p->excerpt,
            'image' => $p->getFirstMedia('products') ? $p->getFirstMedia('products')->getUrl() : null,
            'date_created' => $p->created_at,
            'date_modified' => $p->updated_at
        ])->withQueryString();
        // Render the 'Product/ProductIndex' view using the 'products' data
        return Inertia::render('Product/ProductIndex', [
            'products' => $products,
            'filter' => Request::input('search'),
            'category' => Request::input('category'), 
            'categories' => Category::select(['id', 'title'])->get()->toArray()
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
        //check if validated
        if (!$request->validated()) {
            return abort(400, 'Invalid data');
        }
        //create a new product
        $product_created = $this->product->create([
            'title' => $request->title,
            'category_id' => $request->category,
            'description' => $request->description
        ]);
        //update time if exists
        if($request->date_modified != null){
            $newDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->date_modified);
            $this->product->find($product_created->id)->update([
                'created_at' => $newDate->format('Y-m-d H:i:s')
            ]);
        }
        //add images if exists
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $product_created->addMedia($image)->toMediaCollection('products');
            }
        }
        return redirect()->route('product.index')->with('success', 'New product created successfully!');        
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
                'date_modified' => $product->updated_at,
                'images' => $product->getMedia('products')->map(fn($m) => [
                    'image_id' => $m->id,
                    'filename' => $m->file_name,
                    'url' => $m->getFullUrl(),
                    'size' => $m->human_readable_size
                ])
            ];
            return Inertia::render('Product/ProductShow', [
                'product' => $productData
            ]);
        }
    }
    public function edit($id){
        return Inertia::render('Product/ProductEdit', [
            'product' => $this->product->find($id),
            'categories' => Category::all()->map(fn($c) => [
                'id' => $c->id,
                'name' => $c->title
            ])
        ]);
    }
    public function update($id, ProductRequest $request){
        if (!$request->validated()) {
            return abort(400, 'Invalid data');
        }
        $product = $this->product->find($id);
        if ($product->title === $request->title && $product->category_id === $request->category && $product->description === $request->description) {
            return redirect()->back()->with('success', 'No Changes Detected!');
        }
        $product->update([
            'title' => $request->title,
            'category_id' => $request->category,
            'description' => $request->description
        ]);
        return redirect()->route('product.show', $id);
    }
    public function destroy($id){
        $product = $this->product->find($id);
        $image = $product->getMedia('products');
        if($image->count() != 0){
            $image->each->delete();
        }
        $product->delete();
        return redirect()->back()->with('success', 'Successfully deleted this product');
    }
}
