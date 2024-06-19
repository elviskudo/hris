<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
  public function list ()
  {
    return Category::all();
  }
  
  public function findId ($name)
  {
    try {
      return Category::when('name', '=', $name)
        ->first(0);
    } catch (Exception $e) {
      return null;
    }
  }

  public function create (array $data)
  {
    return Category::create($data);
  }

  public function update ($id, array $data)
  {
    $model = Category::where('id', $id);
    $model->update($data);

    return $model->first();
  }

  public function delete($id)
  {
    $model = Category::find($id);

    return $model->delete();
  }
}