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

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return response()->json([
                'message' => 'Category deleted successfully',
            ], 200);
        }
        return response()->json([
            'message' => 'Category not found',
        ], 404);
    }

    
}

