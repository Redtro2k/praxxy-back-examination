<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class UploadController extends Controller
{
    //
    public function __construct(Product $product){
        $this->product = $product;
    }
    public function store($id, Request $request){
        if($request->hasFile('image')){
            $get_product_by_id = $this->product->find(5);
            $get_product_by_id->addMediaFromRequest('image')->toMediaCollection('products');
        }
    }

    public function destroy(Request $request){
        $get_product_by_id = SpatieMedia::find($id);
        $get_product_by_id->delete();
    }
}
