<?php

namespace Database\Seeders;

use App\Models\Pages\StaticPage;
use Illuminate\Database\Seeder;

class DfStaticPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (StaticPage::$names as $name) {
            StaticPage::create([
                'name' => $name,
                'content' => ''
            ]);
        }
    }
}
