<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionRepository;

class OrderController extends Controller
{
    protected $order;

    public function __construct(TransactionRepository $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $model = $this->order->list();

        return $this->view('orders/list', compact('model'));
    }
}
