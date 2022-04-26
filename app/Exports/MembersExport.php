<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class MembersExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return[
            'Name',
            'Gender',
            'Phone Number',
            'Address'
        ];
    }

    public function map($member): array
    {
         return[
             $member->name,
             $member->gender,
             $member->phone_num,
             $member->address
         ];
    }

    public function query()
    {
        return Member::query();
    }
}
