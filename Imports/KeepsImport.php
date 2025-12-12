<?php

namespace App\Imports;

use App\Models\Keep;
use Maatwebsite\Excel\Concerns\ToModel;

class KeepsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Keep([
            'name'        => $row[0],
            'description' => $row[1],
        ]);
    }
}
