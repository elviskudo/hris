<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;

class DashboardRepository
{
  public function userCount()
  {
    return User::count();
  }

  public function productCount()
  {
    return Product::count();
  }

  public function orderCount()
  {
    return Transaction::count();
  }

  public function supplierCount()
  {
    return Supplier::count();
  }

  public function recentOrders()
  {
    return Transaction::orderBy('id', 'desc')
      ->limit(10)
      ->get();
  }
}