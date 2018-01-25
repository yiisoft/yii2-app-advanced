<?php

return [
    [
        'pattern' => 'sitemap<page:\d+>',
        'route' => 'sitemap/index',
        'suffix' => '.xml'
    ],
    [
        'pattern' => 'sitemap',
        'route' => 'sitemap/index',
        'suffix' => '.xml'
    ],
];
