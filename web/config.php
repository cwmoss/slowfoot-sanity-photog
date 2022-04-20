<?php
print_r($_ENV);
print_r(getenv());
return [
    'site_name' => 'Photographers Protfolio',
    'site_description' => 'look at beautiful works of art',
    'site_url' => '',
    // TODO: solve genenv vs ENV problem
    'path_prefix' => getenv('PATH_PREFIX') ?: $_ENV['PATH_PREFIX']??'',
    'title_template' => '',
    'store' => $_ENV['SLFT_ENV']=='dev'?'sqlite':null,
    'sources' => [
        'sanity' => [
            'dataset' => 'production',
            'projectId' => $_ENV['SANITY_ID'],
            'useCdn' => false,
            'token' => $_ENV['SANITY_TOKEN'],
            'apiVersion' => '2022-04-20',
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
        'page' => '/:slug.current',
        'content' => '/:slug.current',
    ],
    'assets' => [
        'src' => 'images',
        'path' => '/images',
        'profiles' => [
            'small' => [
                'size' => '600x400',
                'mode' => 'fit'
            ],
            'gallery' => [
                'size' => '700x', 
                '4c' => ['creator'=>'Artist Name here :)']
            ]
        ]
    ],
    'plugins' => [
        'sanity'
    ],
    'hooks' => [
        'on_load' => function ($row, $ds) {
            // nothing to do
            return $row;
        }
    ]
];
