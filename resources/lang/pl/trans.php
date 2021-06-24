<?php

return [
    'admin' => [
        'settings' => [
            'shift_time_txt' => 'Szybkość przesunięcia tekstu (s)',
            'logo' => 'Logo',
            'app_name' => 'Nazwa serwisu',
            'duration_promotion' => 'Czas trwania promocji na kurs (d)',
            'types' => [
                \App\Models\Settings\SettingApp::$typeValue['file'] => 'Plik',
                \App\Models\Settings\SettingApp::$typeValue['txt'] => 'Tekst'
            ]
        ]
    ]
];
