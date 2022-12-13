<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection,WithHeadings


{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
        # code...
    }
    public function collection()
    {
       
        return collect($this->data);
    }
    public function headings(): array
    {
        return ["category_id", "contact_number", "Pin code","Sector","City","Country"];
    }
}
