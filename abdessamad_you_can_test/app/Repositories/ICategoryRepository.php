<?php

namespace App\Repositories;

interface ICategoryRepository
{
    public function getCategories();

    public function createCategory($request);

    
    public function deleteCategory($id);





}