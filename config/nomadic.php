<?php

return [
    'global' => [
        'app' => 'Nomadic',
        'subject' => '咖啡廳',
        'unit' => '間',
        'name_of_unit' => '店名',
        'category' => '城市',
        'unit-url' => 'shop'
    ],
    'homepage' => [
        'title' => 'Nomadic',
        'slogan-1' => '讓網友一起整理資料清單、評分的 open source 系統。',
        'slogan-2' => '從 Cafe Nomad 主程式碼中抽離出來而成，改寫為通用架構。',
    ],
    // corresponds to template in resources/views
    'community' => [
        'contribute' => [
            'name-notice' => '若有分店，請註明分店名'
        ]
    ],
    'forum' => [
        'enabled' => true,
        'label' => '討論區',
    ],
    'links' => [
        [
            'url' => 'https://github.com/howtomakeaturn/nomadic',
            'label' => 'Github',
        ],
    ],
    'tag-page' => [
        'unit' => '間網友推薦的店'
    ],
    'category-homepage' => [
        'unit-amount' => '間店',
        'checkin-amount' => '次打卡',
        'empty-comment-text' => '這個地區還沒有人留言。',
        'empty-review-text' => '這個地區還沒有人評分。'
    ],
    'info-modal' => [
        'check-in' => '我去過這間',
        'num-of-visit' => '人去過這間店。',
        'write-a-review' => '我要給這間店評分',
    ]
];
