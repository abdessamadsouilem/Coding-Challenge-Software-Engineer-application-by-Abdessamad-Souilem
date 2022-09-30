<?php

namespace App\Repositories;
use App\Models\Product;
use App\Repositories\IProductRepository;
use Illuminate\Support\Facades\Validator;

class ProductRepository implements IProductRepository
{

    public function getProducts($request)
    {

        $products = Product::query();
        if($request->has('category_id')){
            $products->where('category_id', $request->category_id);
        }
        if($request->has('price')){
            $products->where('price', $request->price);
        }
        return $products->get();
    }

    public function createProduct($request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
           
        ]);
       
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        // upload image
        if($request->hasFile('image')){
        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();
        $image->move(public_path('/images'),$image_name);
        $image_path = "/images/" . $image_name;
        $product->image = $image_name;
        }
        $product->save();
        try {
            return response()->json([
                'message' => 'Product created successfully',
                'product' => $product
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Product created failed',
                'error' => $th->getMessage()
            ], 500);
        }
    }

}
