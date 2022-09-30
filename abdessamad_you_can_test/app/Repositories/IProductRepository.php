<?php

namespace App\Repositories;

interface IProductRepository
{
    public function getProducts($request);

    public function createProduct($request);

}