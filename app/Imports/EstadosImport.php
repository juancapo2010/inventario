<?php

namespace App\Imports;

use App\Estado;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EstadosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Estado([
            'nama'          => $row['nama'],
            'alamat'        => $row['alamat'],
            'email'         => $row['email'],
            'telepon'       => $row['telepon']
        ]);
    }
}
