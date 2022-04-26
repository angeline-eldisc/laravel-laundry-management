<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'name' => 'Diana Rosevelt',
            'address' => 'Jln Merdeka Barat, Jakarta Selatan',
            'gender' => 'Female',
            'phone_num' => '08128394870'
        ]);

        Member::create([
            'name' => 'Souma Jaya',
            'address' => 'Jln Melati Putih, Jakarta Barat',
            'gender' => 'Male',
            'phone_num' => '08182736460'
        ]);

        Member::create([
            'name' => 'Biana Putri',
            'address' => 'Jln Mangga Segar, Jakarta Timur',
            'gender' => 'Female',
            'phone_num' => '08127364850'
        ]);

        Member::create([
            'name' => 'Jayanama Hali',
            'address' => 'Jln Kebun Apel, Jakarta Utara',
            'gender' => 'Male',
            'phone_num' => '08283749520'
        ]);

        Member::create([
            'name' => 'Pania Sanjaya',
            'address' => 'Jln Matahari Terbit, Jakarta Pusat',
            'gender' => 'Female',
            'phone_num' => '0818273950'
        ]);
    }
}
