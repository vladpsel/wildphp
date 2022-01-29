<?php

declare(strict_types=1);

return [
    'multilingual' => true,
    'defaultLang' => 'uk',
    'templates' => [
        'head' => [
            'template' => 'user/layout/head.php',
            'dataExtractor' => 'Voopsc\Wild\Helper\MetaExtractor',
        ],
        'header' => '',
        'footer' => '',
    ],
];
