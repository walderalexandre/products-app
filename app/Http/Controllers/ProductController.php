<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Throwable;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $pageSize = $request->query('page_size', 10);
            $page = $request->query('page', 1);

            $products = $this->service->getAllProducts($pageSize, $page);
           
            return response()->json(['data' => ProductResource::collection($products->items()),
                                     'meta' => ['current_page' => $products->currentPage()]],
                                     $products->isEmpty() ? 204 : 200);
        } catch (Throwable $e) {
            $this->logError($e);
            return $this->errorResponse('Erro ao listar produtos.');
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = $this->service->getProductById($id);
            return $this->successResponse(new ProductResource($product));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Produto não encontrado.');
        } catch (Throwable $e) {
            $this->logError($e);
            return $this->errorResponse('Erro ao exibir produto.');
        }
    }

    public function store(ProductRequest $request): JsonResponse
    {
        try {
            $product = $this->service->createProduct($request->validated());
            return response()->json(['data' => new ProductResource($product)], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Throwable $e) {
            $this->logError($e);
            return $this->errorResponse('Erro ao criar produto.');
        }
    }

    public function update(ProductRequest $request, $id): JsonResponse
    {
        try {
            $product = $this->service->updateProduct($id, $request->validated());
            return $this->successResponse(new ProductResource($product));
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Produto não encontrado.');
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Throwable $e) {
            $this->logError($e);
            return $this->errorResponse('Erro ao atualizar produto.');
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $product = $this->service->deleteProduct($id);
            return response()->json(['message' => 'Produto excluído com sucesso'], $product ? 204 : 404);
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Produto não encontrado.');
        } catch (Throwable $e) {
            $this->logError($e);
            return $this->errorResponse('Erro ao excluir produto.');
        }
    }
}
