<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
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
        return $this->productRepository->paginate($pageSize, $page);
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data): Product
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id): Product
    {
        return $this->productRepository->delete($id);
    }
}
