<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'activo_id'          => $row['nama'],
            'sn'        => $row['sn'],
            'category_id'        => $row['categoria'],
            'supplier_id'        => $row['estado'],
            'image'        => $row['imagen'],
            'qty'        => $row['nombre_de_red'],
            'customer_id'        => $row['asignable'],

        ]);
    }
}
