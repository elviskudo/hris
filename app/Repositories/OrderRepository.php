<?php

namespace App\Repositories;

use App\Models\Transaction;

class OrderRepository
{
  public function list ($perPage = null, $search = null, $orderBy = null)
  {
    return Transaction::when($search, function ($query) use ($search) {
      $query->where('name', 'like', '%' . $search . '%');
    })
      ->paginate($perPage);
  }

  public function detail ($id)
  {
    return Transaction::find($id);
  }

  public function create (array $data)
  {
    return Transaction::create($data);
  }

  public function update ($id, array $data)
  {
    $model = Transaction::find($id)
    ->update($data);

    return $model->first();
  }

  public function delete ($id)
  {
    return Transaction::delete($id);
  }
}