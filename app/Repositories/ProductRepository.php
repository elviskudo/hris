<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function list($perPage = null, $search = null, $orderBy = null)
    {
        return Product::with(['supplier', 'category'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when(isset($orderBy), function ($query) use ($orderBy) {
                $query->orderBy('name', $orderBy);
            })
            ->paginate($perPage);
    }

    public function findId ($name)
    {
        try {
            return Product::when('name', '=', $name)
                ->first(0);
        } catch (Exception $e) {
            return null;
        }
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