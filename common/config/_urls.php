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


        /*'/' => 'site/index',
        '<_c:(\w|-)+>' => '<_c>/index',
        //'<_c:(\w|-)+>/'=>'<_c>/index',
        '<_c:(\w|-)+>/<id:\d+>'=>'<_c>/view',
        '<_c:(\w|-)+>/<_a:(\w|-)+>/<id:\d+>'=>'<_c>/<_a>',
        '<_c:(\w|-)+>/<_a:(\w|-)+>'=>'<_c>/<_a>',*/
    ];