<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;
use Inertia\Inertia;

class UploadController extends Controller
{
    public function __construct(Product $product){
        $this->product = $product;
    }
    public function store(Request $request){
        if($request->hasFile('images')){
            $get_product_by_id = $this->product->find($request->id);
            $get_product_by_id->addMediaFromRequest('images')->toMediaCollection('products');
            return redirect()->route('product.show', $request->id);
        }
    }
    public function destroy($id){
        $get_product_by_id = SpatieMedia::find($id);
        $get_product_by_id->delete();
        return redirect()->back();
    }
}
