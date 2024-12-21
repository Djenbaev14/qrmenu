<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ProductImport implements ToModel,WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function getCsvSettings(): array
    {
        return [
            'name_uz' => 'UTF-8', // Kodlashni UTF-8 qilib belgilang
            'name_kr' => 'UTF-8', // Kodlashni UTF-8 qilib belgilang
            'name_ru' => 'UTF-8', // Kodlashni UTF-8 qilib belgilang
        ];
    }
    public function model(array $row)
    {
        return new Product([
            // 'unit_id'   => $row[10],
            // 'company_id'   => $row[10],
            'category_id'   => $row[6],
            'name_uz'   => $row[0],
            'name_kr'   => $row[4],
            'name_ru'   => $row[2],
            'description_uz'   => $row[1] ,
            'description_kr'   => $row[5],
            'description_ru'   => $row[3],
            'sequence_number'   => $row[9],
            'photo'   => $row[7],
            'price'   => $row[8],
        ]);
    }
}
