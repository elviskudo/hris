<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Product;
use App\Repositories\SupplierRepository;
use App\Repositories\CategoryRepository;

class ProductsImport implements ToModel, WithHeadingRow
{
    protected $supplier;
    protected $category;

    public function __construct (SupplierRepository $suppliers, CategoryRepository $categories)
    {
        $this->supplier = $supplier;
        $this->category = $category;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'supplier_id' => $this->suppliers->findId($row['supplier']),
            'category_id' => $this->categories->findId($row['category']),
            'code' => $row['code'],
            'name' => $row['name'],
            'description' => $row['description'],
            'price' => $row['price'],
            'stock' => $row['stock']
        ]);
    }
}
