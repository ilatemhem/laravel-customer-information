<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('customers')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@doe.com',
                'gsm_no' => 905331234567,
                'department_id' => 1,
                'birthday' => '1987-12-10',
            ],
            [
                'name' => 'Mary Lee',
                'email' => 'mary@lee.com',
                'gsm_no' => 905331234568,
                'department_id' => 2,
                'birthday' => '1985-10-30',
            ],
        ]);
    }
}
