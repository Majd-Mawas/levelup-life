<?php

return [
    'mode'                  => 'utf-8',
    'format'                => 'A4',
    'author'                => '',
    'subject'               => '',
    'keywords'              => '',
    'creator'               => 'Laravel Pdf',
    'display_mode'          => 'fullpage',
    'tempDir'               => storage_path('app'),
    'pdf_a'                 => false,
    'pdf_a_auto'            => false,
    'icc_profile_path'      => '',
    'font_path'             => storage_path('fonts/'),
    'font_data'             => [
        'arial' => [
            'R'  => 'arial/arial.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
    ],
];