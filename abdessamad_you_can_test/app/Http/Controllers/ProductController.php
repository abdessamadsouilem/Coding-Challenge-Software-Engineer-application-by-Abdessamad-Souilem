<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\IProductRepository;

class ProductController extends Controller
{

    public $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // upload image
        if($request->hasFile('image')){
        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();
        $image->move(public_path('/images'),$image_name);
        $image_path = "/images/" . $image_name;
        $request->image = $image_name;
        }

        // create the product
       return $this->productRepository->createProduct($request);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    // get product list with ability to sort by  price, category
    public function index(Request $request)
    {
    
        return $this->productRepository->getProducts($request->request);
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */

    public function destroy($id)
    {
        return $this->productRepository->deleteProduct($id);
    }

    

}
