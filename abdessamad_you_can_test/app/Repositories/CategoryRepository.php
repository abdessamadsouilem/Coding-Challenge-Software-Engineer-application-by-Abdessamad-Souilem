<?php

namespace App\Repositories;
use App\Models\Category;
use App\Repositories\ICategoryRepository;
use Illuminate\Support\Facades\Validator;

class CategoryRepository implements ICategoryRepository
{
    public function getCategories()
    {
        return Category::all();
    }


    public function createCategory($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
            'parent' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->parent_category = $request->parent;
        $category->save();
        try {
            return response()->json([
                'message' => 'Category created successfully',
                'category' => $category
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Category created failed',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    
}

