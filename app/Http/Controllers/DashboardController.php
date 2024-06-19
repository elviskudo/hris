<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DashboardRepository;

class DashboardController extends Controller
{
    protected $dashboard;

    public function __construct(DashboardRepository $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    public function index ()
    {
        $data = [
            'orderCount' => $this->dashboard->orderCount(),
            'productCount' => $this->dashboard->productCount(),
            'userCount' => $this->dashboard->userCount(),
            'supplierCount' => $this->dashboard->supplierCount(),
            'recentOrders' => $this->dashboard->recentOrders(),
        ];

        return view('dashboard/main', compact('data'));
    }

    public function maps ()
    {
        return view('maps');
    }
}
