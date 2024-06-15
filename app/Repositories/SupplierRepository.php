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
}