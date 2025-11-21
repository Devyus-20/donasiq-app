<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
        public function run(): void
    {
        $usersData=[
            [
                'name'=>'crm',
                'email'=>'crm@gmail.com',
                'role'=>'crm',
                'password'=>bcrypt('123456'),
            ],
            [
                'name'=>'keuangan',
                'email'=>'keuangan@gmail.com',
                'role'=>'keuangan',
                'password'=>bcrypt('7891011'),
            ],
        ];

        foreach ($usersData as $key => $value){
            User::create($value);
        }
    }
}
