<?php

namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository
{
  public function list()
  {
    return Supplier::all();
  }

  public function detail($id)
  {
    return Supplier::find($id);
  }

  public function create (array $data)
  {
    return Supplier::create($data);
  }

  public function update ($id, array $data)
  {
    $model = Supplier::where('id', $id);
    $model->update($data);

    return $model->first();
  }

  public function delete($id)
  {
    $model = Supplier::find($id);

    return $model->delete();
  }
}