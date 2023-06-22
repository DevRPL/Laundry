<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * abis itu buat user admin xan kasir masing2 cabang.
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Demo',
                'email' => 'demo@test.test',
                'email_verified_at' => now(),
                'password' => bcrypt('demo123'), 
                'remember_token' => str_random(10),
                'branch_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );
    }
}
