<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class todoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name' => 'To do','is_active' => 1]);
        Status::create(['name' => 'In progress','is_active' => 1]);
        Status::create(['name' => 'Done','is_active' => 1]);
    }
}
