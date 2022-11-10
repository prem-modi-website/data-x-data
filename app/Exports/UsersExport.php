<?php

namespace App\Exports;

use App\Category;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection,withHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data) 
    {
        $this->data = $data;
    }

    public function collection()
    {
        //print_r("eeeee");
                //$data = ["ggg","hhh"];
        //return $data;
        
        return $this->data;
        
        //return $this->data;
    }
    public function headings(): array
    {
        return [
            'Contact Number',
            'Pincode',
            'Category',
            'State',
            'City',
            'Country'
        ];
    }
}
