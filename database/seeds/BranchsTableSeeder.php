<?php

use Illuminate\Database\Seeder;
use App\Entities\Branch;

class BranchsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * abis itu buat user admin xan kasir masing2 cabang.
     */
    public function run()
    {
        Branch::create(
            [
                'name' => 'Demo Laundry',
                'branch_name' => 'Pusat',
                'address' => 'Jl Abc',
                'phone' => '022232987653', 
                'email' => 'demolaundry@gmail.com'
            ]
        );
    }
}
