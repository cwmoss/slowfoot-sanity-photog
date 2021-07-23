<?php

return [
    'site_name' => 'Photographers Protfolio',
    'site_description' => 'look at beautiful works of art',
    'site_url' => '',
    // TODO: solve genenv vs ENV problem
    'path_prefix' => getenv('PATH_PREFIX') ?: $_ENV['PATH_PREFIX'] ?: '',
    'title_template' => '',
    'sources' => [
        'sanity' => [
            'dataset' => 'production',
            'projectId' => $_ENV['SANITY_ID'],
            'useCdn' => true,
            // 'query' => '*[_type=="custom-type-query"]'
        ]
       
    ],
    'preview' => [
        'sanity' => [
            'dataset' => 'production',
            'projectId' => $_ENV['SANITY_ID'],
            'useCdn' => false,
            //'withCredentials' => true,
            'token' => $_ENV['SANITY_TOKEN']
        ]
    ],
    'templates' => [
        'gallery_page' => '/g/:slug.current',
    ],
    'assets' => [
        'dir' => 'images',
        'path' => '/images',
        'profiles' => [
            'small' => [
                's' => '600x400',
                'mode' => 'fit'
            ],
            'gallery' => [
                's' => '700x', 
                '4c' => ['creator'=>'Artist Name here :)']
            ]
        ]
    ],
    'hooks' => [
        'on_load' => function ($row, $ds) {
            // nothing to do
            return $row;
        }
    ]
];
