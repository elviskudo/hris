<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function list()
    {
        return Product::with(['supplier', 'category'])->get();
    }

    public function detail($id)
    {
        return Product::with(['supplier', 'category'])->find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update ($id, array $data)
    {
        $model = Product::where('id', $id);
        $model->update($data);

        return $model->first();
    }

    public function delete($id)
    {
        $model = Product::find($id);

        return $model->delete();
    }
}