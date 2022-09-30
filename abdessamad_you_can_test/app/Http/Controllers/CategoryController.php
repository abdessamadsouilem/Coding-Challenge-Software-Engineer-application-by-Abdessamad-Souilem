<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ICategoryRepository;

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
