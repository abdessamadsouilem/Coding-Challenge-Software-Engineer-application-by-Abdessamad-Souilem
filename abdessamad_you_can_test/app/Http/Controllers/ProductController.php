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

        return $this->productRepository->getProducts($request);
        
    }

    

}
