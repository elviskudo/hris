<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SupplierRepository;

class SupplierController extends Controller
{
    protected $supplier;

    public function __construct(SupplierRepository $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index()
    {
        $model = $this->supplier->list();

        return $this->view('suppliers/list', compact('model'));
    }
}
