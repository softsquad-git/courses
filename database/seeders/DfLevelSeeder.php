<?php

namespace Database\Seeders;

use App\Models\Courses\Level;
use Illuminate\Database\Seeder;

class DfLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'name' => 'Poziom podstawowy'
        ]);
    }
}
