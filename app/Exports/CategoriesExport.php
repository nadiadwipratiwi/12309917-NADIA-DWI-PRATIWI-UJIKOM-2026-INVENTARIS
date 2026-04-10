<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('name', 'division_pj', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Division PJ',
            'Date',
        ];
    }
}
