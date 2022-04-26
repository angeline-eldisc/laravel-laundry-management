<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'phone_num' => '081928371934',
            'gender' => 'Female',
            'address' => 'Jl Iranma Barat No 98',
            'role' => 'admin',
            'profile' => 'admin.png'
        ]);

        User::create([
            'name' => 'Cashier',
            'username' => 'cashier',
            'email' => 'cashier@mail.com',
            'password' => bcrypt('cashier'),
            'phone_num' => '081928371934',
            'gender' => 'Male',
            'address' => 'Jl Iranma Utara No 12',
            'role' => 'cashier',
            'profile' => 'cashier.png'
        ]);

        User::create([
            'name' => 'Owner',
            'username' => 'owner',
            'email' => 'owner@mail.com',
            'password' => bcrypt('owner'),
            'phone_num' => '081928371934',
            'gender' => 'Male',
            'address' => 'Jl Iranma Selatan No 42',
            'role' => 'owner',
            'profile' => 'owner.png'
        ]);
    }
}
