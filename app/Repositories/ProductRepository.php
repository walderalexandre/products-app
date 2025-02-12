<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all()->sortBy("nome");
    }

    public function paginate(int $pageSize, int $page)
    {
        return $this->model->orderBy('nome')->paginate($pageSize, ['*'], 'page', $page);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->model->findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->model->findOrFail($id);
        $product->delete();
        return $product;
    }

    public function findByField(string $field, $value)
    {
        return $this->model->where($field, $value)->get();
    }
}
