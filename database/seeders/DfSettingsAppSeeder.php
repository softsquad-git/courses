<?php

namespace Database\Seeders;

use App\Models\Settings\SettingApp;
use Illuminate\Database\Seeder;

class DfSettingsAppSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'shift_time_txt',
                'type' => SettingApp::$typeValue['txt'],
                'value' => ''
            ],
            [
                'name' => 'logo',
                'type' => SettingApp::$typeValue['file'],
                'value' => ''
            ],
            [
                'name' => 'app_name',
                'type' => SettingApp::$typeValue['txt'],
                'value' => ''
            ],
            [
                'name' => 'duration_promotion',
                'type' => SettingApp::$typeValue['txt'],
                'value' => ''
            ]
        ];

        SettingApp::insert($data);
    }
}
