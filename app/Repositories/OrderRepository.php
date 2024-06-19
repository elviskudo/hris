<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Product;
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
    try {
      // begin database transaction
      DB::beginTransaction();
      
      // update stock in products
      $model = Product::find($data['product_id']);

      if ($model->stock > 0) {
        $stockLeft = 0;
        if ($model->stock - $data['quantity'] > 0) {
          $stockLeft = $model->stock - $data['quantity'];

          $model->update(['stock' => $stockLeft]);
        } else {
          throw new \Exception('Stock is not enough');
        }
      }

      $createData = Transaction::create($data);
      // if data is great, then submit the data
      DB::commit();

      return $createData;
    } catch (\Exception $e) {
      DB::rollBack();

      return [];
    }
  }

  public function update ($id, array $data)
  {
    $model = Transaction::find($id);
    $model->update($data);

    return $model->first();
  }

  public function summary ($start, $end)
  {
    return Transaction::whereBetween('transaction_date', [$start, $end])->get();
  }

  public function delete ($id)
  {
    return Transaction::delete($id);
  }
}