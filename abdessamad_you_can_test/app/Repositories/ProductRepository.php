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

    public function createProduct($products)
    {  
        $product = new Product();
        $product->name = $products->name;
        $product->description = $products->description;
        $product->price = $products->price;
        $product->category_id = $products->category_id;
        $product->image = $products->image;
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

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully',
            ], 200);
        }
        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }

}
