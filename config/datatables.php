<?php

return [

    'search'  => [
        'case_insensitive' => false, //TODO: разобраться с caseinsensitive, похоже в sqlite другие query
        'use_wildcards'    => false,
    ],

    'fractal' => [
        'serializer' => 'League\Fractal\Serializer\DataArraySerializer',
    ],
];
