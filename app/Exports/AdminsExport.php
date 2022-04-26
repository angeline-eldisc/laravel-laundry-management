<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class AdminsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return[
            'Name',
            'Username',
            'E-mail Address',
            'Gender',
            'Phone Number',
            'Address'
        ];
    }

    public function map($admin): array
    {
         return[
             $admin->name,
             $admin->username,
             $admin->email,
             $admin->gender,
             $admin->gender,
             $admin->address
         ];
    }

    public function query()
    {
        return User::query()->where('role', 'admin');
    }
}
