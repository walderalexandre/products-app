<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use App\Exceptions\ProductNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Product;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(int $pageSize, int $page)
    {
        return $this->productRepository->paginate($pageSize, $page); // Chama o método paginate do repository
    }

    public function getProductById($id)
    {
        try {
            return $this->productRepository->find($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException("Produto não encontrado", 404);
        }
    }

    public function createProduct(array $data): Product
    {
       // Lógica de negócio opcional aqui (ex: validar dados, etc.)

        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data): Product
    {
        try {
            return $this->productRepository->update($id, $data);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException("Produto não encontrado", 404);
        }
    }

    public function deleteProduct($id): Product
    {
        try {
            return $this->productRepository->delete($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException("Produto não encontrado", 404);
        }
    }
}
