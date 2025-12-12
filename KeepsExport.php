<?php

namespace App\Exports;

use App\Models\Keep;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeepsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Keep::all();
    }
}
