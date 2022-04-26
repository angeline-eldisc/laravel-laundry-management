<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outlet::create([
            'name' => 'Meisya Laundry',
            'address' => 'Jl Patra 26 Duri Kepa, Jakarta Barat',
            'phone_num' => '08128938490',
            'profile' => 'laundry-logo-icon.png'
        ]);
    }
}
