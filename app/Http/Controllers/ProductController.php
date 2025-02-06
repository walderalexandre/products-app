<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return $this->service->getAllProducts();
    }

    public function show($id): JsonResponse
    {
        return $this->service->getProductById($id);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        return $this->service->createProduct($request->validated());
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        return $this->service->updateProduct($id, $request->validated());
    }

    public function destroy($id): JsonResponse
    {
        return $this->service->deleteProduct($id);
    }
}
