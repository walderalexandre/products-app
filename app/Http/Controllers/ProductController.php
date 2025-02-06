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
        try {
            $products = $this->service->all();
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = $this->service->find($id);
            if (!$product) {
                return response()->json(['message' => 'Produto não encontrado'], 404);
            }
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function store(ProductRequest $request): JsonResponse
    {
        try {
            $product = $this->service->create($request->validated());
            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        try {
            $product = $this->service->update($id, $request->validated());
            if (!$product) {
                return response()->json(['message' => 'Produto não encontrado'], 404);
            }
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $product = $this->service->delete($id);
            if (!$product) {
                return response()->json(['message' => 'Produto não encontrado'], 404);
            }
            return response()->json(['message' => 'Produto excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
