<?php

namespace App\Imports;

use App\Asignable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AsignablesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Asignable([
            'nama'          => $row['nombre'],
            'alamat'        => $row['sector'],
            'email'         => $row['email'],
            'telepon'       => $row['telefono']
        ]);
    }
}
