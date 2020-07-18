<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    public function store($data) {
        $result = $this->productRepository->create($data);
        return $result;
    }

    public function getWhere($column, $value) {
        $result = $this->productRepository->getWhere($column, $value);
        return $result;
    }

    public function update($column, $value,  $data) {
        $result = $this->productRepository->update($column, $value, $data);
        return $result;
    }

    public function delete($column, $value) {
        $result = $this->productRepository->delete($column, $value);
        return $result;
    }
}
