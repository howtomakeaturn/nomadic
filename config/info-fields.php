<?php

return [
    [
        'key' => 'info-field-1',
        'label' => '字串欄位 1',
        'type' => 'input_text'
    ],
    [
        'key' => 'info-field-2',
        'label' => '字串欄位 2',
        'type' => 'input_text'
    ],
    [
        'key' => 'info-field-3',
        'label' => '字串欄位 3',
        'type' => 'input_text'
    ],
    [
        'key' => 'info-field-4',
        'label' => '可選欄位 4',
        'type' => 'input_radio',
        'options' => [
            ['key' => 'yes', 'label' => '有 '],
            ['key' => 'no', 'label' => '無 '],
        ]
    ],
    [
        'key' => 'info-field-5',
        'label' => '選單欄位 5',
        'type' => 'select',
        'options' => [
            ['key' => 'yes', 'label' => '有 '],
            ['key' => 'no', 'label' => '無 '],
        ]
    ],
];
