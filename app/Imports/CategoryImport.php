<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CategoryImport implements ToModel ,WithCustomCsvSettings
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
        return new Category([
            'company_id'   => $row[5],
            'name_uz'   => $row[3] ,
            'name_kr'   => $row[2],
            'name_ru'   => $row[4],
            'sequence_number'   => $row[1],
            'photo'   => $row[0],
        ]);
    }
}
