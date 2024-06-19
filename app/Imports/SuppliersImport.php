<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Product;

class SuppliersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Supplier([
            'code' => $row['code'],
            'name' => $row['name'],
            'address' => $row['address'],
            'pic_name' => $row['pic_name'],
            'pic_phone' => $row['pic_phone']
            'pic_npwp' => $row['pic_npwp']
        ]);
    }
}
