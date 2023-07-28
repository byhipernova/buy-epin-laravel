<?php

namespace Database\Seeders;

use App\Models\Epin;
use Illuminate\Database\Seeder;

class EpinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Epin::factory()->count(10)->create();
    }
}
