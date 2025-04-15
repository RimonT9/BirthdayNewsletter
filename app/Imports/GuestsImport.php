<?php

namespace App\Imports;

use App\Models\Guest;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuestsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $item)
            if (isset($item['email']) && $item['email'] != null){
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($item['birthday']);
                Guest::firstOrCreate([
                    'email' => $item['email']
                ],[
                    'name' => $item['name'],
                    'telephone' => $item['telephone'],
                    'email' => $item['email'],
                    'birthday' => $date->format('Y-m-d'),
                ]);
            }  
    }
}
