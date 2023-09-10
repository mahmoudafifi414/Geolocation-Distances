<?php

return [
    'OUTPUT_STRATEGY' => 'csv',
    'OUTPUT_STRATEGY_FILE_NAME' => 'distances.csv',
    'LOCATION_TYPES' => ['DESTINATION' => 'destination', 'ORIGIN' => 'origin'],
    'TABLE_COLUMNS_HEADINGS' => ['SortNumber', 'Distance', 'Name', 'Address'],
    'UNIT' => ['KM' => 'km'],
    'POSITIONSTACK_API_KEY' => env('POSITIONSTACK_API_KEY'),
    'POSITIONSTACK_V1_API_URL' => env('POSITIONSTACK_V1_API_URL'),
    'LOCATIONS' => [
        "DESTINATION" => "Adchieve HQ - Sint Janssingel 92, 5211 DA 's-Hertogenbosch, The Netherlands",
        'ORIGIN' => [
            "Eastern Enterprise B.V. - Deldenerstraat 70, 7551AH Hengelo, The Netherlands",
            "Eastern Enterprise - 46/1 Office no 1 Ground Floor , Dada House , Inside dada silk mills",
            "compound, Udhana Main Rd, near Chhaydo Hospital, Surat, 394210, India",
            "Adchieve Rotterdam - Weena 505, 3013 AL Rotterdam, The Netherlands",
            "Sherlock Holmes - 221B Baker St., London, United Kingdom",
            "The White House - 1600 Pennsylvania Avenue, Washington, D.C., USA",
            "The Empire State Building - 350 Fifth Avenue, New York City, NY 10118",
            "The Pope - Saint Martha House, 00120 Citta del Vaticano, Vatican City",
            "Neverland - 5225 Figueroa Mountain Road, Los Olivos, Calif. 93441, USA"
        ]
    ],
    'EXCEPTION_MESSAGES' => [
        'NO_DESTINATION_DATA' => 'There is no destination geolocation data',
        'NO_ORIGIN_DATA' => 'There is no origin geolocation data',
    ]
];
