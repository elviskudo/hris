<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $product;

    public function __construct(ProductRepository $product)
    {
        $model = $this->product->list();

        return $this->view('products/list', compact('model'));
    }
}
