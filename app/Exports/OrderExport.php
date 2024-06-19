<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Transaction;

class OrderExport implements FromCollection, WithHeadings
{
  use Exportable;

  protected $start;
  protected $end;

  public function __construct ($start, $end)
  {
    $this->start = $start;
    $this->end = $end;
  }

  public function collection (): array
  {
    $orders = Transaction::whereBetween('transaction_date', [$this->start, $this->end])->get();

    $data = [];
    foreach ($orders as $order) {
      $data[] = [
        $order->id,
        $order->user->name,
        $order->code,
        $order->product->name,
        $order->product->stock,
        $order->quantity,
        $order->transaction_date,
      ];
    }

    return $data;
  }
  
  public function headings (): array
  {
    return [
      'ID',
      'User Name',
      'Code',
      'Product Name',
      'Product Stock',
      'Quantity',
      'Order Date'
    ];
  }
}