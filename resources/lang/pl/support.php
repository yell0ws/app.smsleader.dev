<?php

return [
    
    'contact' => [
        'section' => [
            'required' => 'Pole dział jest wymagane',
            'in' => 'Wprowadzona wartość jest nieprawidłowa dla pola dział',
        ],

        'title' => [
            'required' => 'Pole tytuł wiadomości jest wymagane',
            'min' => 'Tytuł wiadomości powinien składać się minimalnie z :min znaków',
            'max' => 'Tytuł wiadomości może składać się maksymalnie z :max znaków',
        ],

        'message' => [
            'required' => 'Pole treść wiadomości jest wymagane',
            'min' => 'Treść wiadomości powinna składać się minimum z :min znaków',
        ],

    ],
];
