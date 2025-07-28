<?php

namespace App\Exports;

use App\Models\Product; // Adjust this import based on your Product model location
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Retrieve all products data
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Pet Name',
            'Image',
            'Age',
            'Category',
            'Description',
            'Created At',
            'Updated At',
        ];
    }
}