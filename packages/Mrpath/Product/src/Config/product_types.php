<?php

return [
    'simple'       => [
        'key'   => 'simple',
        'name'  => 'Simple',
        'class' => 'Mrpath\Product\Type\Simple',
        'sort'  => 1,
    ],

    'configurable' => [
        'key'   => 'configurable',
        'name'  => 'Configurable',
        'class' => 'Mrpath\Product\Type\Configurable',
        'sort'  => 2,
    ],

    'virtual'      => [
        'key'   => 'virtual',
        'name'  => 'Virtual',
        'class' => 'Mrpath\Product\Type\Virtual',
        'sort'  => 3,
    ],

    'grouped'      => [
        'key'   => 'grouped',
        'name'  => 'Grouped',
        'class' => 'Mrpath\Product\Type\Grouped',
        'sort'  => 4,
    ],

    'downloadable' => [
        'key'   => 'downloadable',
        'name'  => 'Downloadable',
        'class' => 'Mrpath\Product\Type\Downloadable',
        'sort'  => 5,
    ],
    
    'bundle'       => [
        'key'  => 'bundle',
        'name'  => 'Bundle',
        'class' => 'Mrpath\Product\Type\Bundle',
        'sort'  => 6,
    ]
];