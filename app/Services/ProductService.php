<?php
namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
     protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        try {
            $products = $this->productRepository->all();
             if ($products->isEmpty()) {
                return response()->json(['message' => 'Não há produtos disponíveis'], 404);
            }
            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getProductById($id)
    {
        try {
            $product = $this->productRepository->find($id);
        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function createProduct(array $data)
    {
        try {
            $product = $this->productRepository->create($data);
            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateProduct($id, array $data)
    {
        try {
            $product = $this->productRepository->update($id, $data);
            if (!$product) {
                return response()->json(['message' => 'Produto não encontrado'], 404);
            }
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = $this->productRepository->delete($id);
            if (!$product) {
                return response()->json(['message' => 'Produto não encontrado'], 404);
            }
            return response()->json(['message' => 'Produto excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
