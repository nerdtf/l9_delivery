<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\IndexRequest;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\Products\ProductsCollection;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use App\Http\Resources\Products\ProductResource;

class ProductController extends Controller
{

    public function __construct (
        private readonly ProductRepository $productRepository,
        private readonly ProductService $productService
    ){}

    public function index(IndexRequest $request)
    {
        return new ProductsCollection(
            $this->productRepository->index($request->validated())
        );
    }


    public function show($id)
    {
        return new ProductResource(
            $this->productRepository->show($id)
        );
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        return new ProductResource(
            $this->productService->update($product, $request->validated())
        );
    }


}
