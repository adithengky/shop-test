<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Repository\Product\ProductRepoInterface;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepoInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        $product = $this->productRepository->getDatatable();
        return $this->successResponse(200, 'success', $product);
    }

    public function get($id) {
        $product = $this->productRepository->find('id', $id);
        if (!$product) {
            return $this->errorResponse(404, 'Not Found');
        }
        return $this->successResponse(200, 'success', $product);
    }

    public function store(ProductRequest $request) {
        $input = $request->only('name', 'price');
        $result = $this->productRepository->create($input);
        return $this->successResponse(200, 'success');
    }

    public function update(ProductRequest $request, $id) {
        $product = $this->productRepository->find('id', $id);
        if (!$product) {
            return $this->errorResponse(404, 'Not Found');
        }
        $input = $request->only('name', 'price');
        $result = $this->productRepository->update('id', $id, $input);
        return $this->successResponse(200, 'success');
    }

    public function delete($id) {
        $product = $this->productRepository->find('id', $id);
        if (!$product) {
            return $this->errorResponse(404, 'Not Found');
        }
        $result = $this->productRepository->delete('id', $id);
        return $this->successResponse(200, 'success');
    }
}
