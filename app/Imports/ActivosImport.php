<?php

namespace App\Imports;

use App\Activo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActivosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Activo([
            'name'          => $row['name'],
            'descripcion'   => $row['descripcion']   
        ]);
    }
}
