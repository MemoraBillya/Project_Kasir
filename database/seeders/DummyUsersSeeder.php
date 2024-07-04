<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name' => 'admin1',
                'email' => 'admin1@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'petugasgudang1',
                'email' => 'gudang1@gmail.com',
                'role' => 'petugasgudang',
                'password' => bcrypt('12345')
            ],
            [
                'name' => 'kasir1',
                'email' => 'kasir1@gmail.com',
                'role' => 'kasir',
                'password' => bcrypt('12345')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
