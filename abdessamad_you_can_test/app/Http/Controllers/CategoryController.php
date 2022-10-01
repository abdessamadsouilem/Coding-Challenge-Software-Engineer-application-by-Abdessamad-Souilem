<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ICategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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
        ]);
        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        return $this->categoryRepository->createCategory($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    public function index()
    {
        return $this->categoryRepository->getCategories();
    }
}
