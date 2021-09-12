<?php

namespace Database\Seeders;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([[
            'name' => 'Muhasebe',
            'created_at' => Carbon::now()
        ], [
            'name' => 'Pazarlama',
            'created_at' => Carbon::now()
        ]]);
    }
}
