<?php

return [
    
    'password' => [
        'old_password' => [
            'required' => 'Pole aktualne hasło jest wymagane',
            'min' => 'Hasło powinno składać się minimum z :min znaków',
        ],

        'new_password' => [
            'required' => 'Pole nowe hasło jest wymagane',
            'min' => 'Hasło powinno składać się minimum z :min znaków',
            'different' => 'Nowe hasło nie może być takie samo jak aktualne hasło',
            'confirmed' => 'Wprowadzone przez ciebie hasła nie są identyczne',
        ],  

        'new_password_confirmation' => [
            'required' => 'Pole powtórz nowe hasło jest wymagane',
        ],

    ],

    'account' => [
        'gg_number' => [
            'required' => 'Pole aktualne hasło jest wymagane',
            'min' => 'Hasło powinno składać się minimum z :min znaków',
        ],

        'rank_view' => [
            'required' => 'Pole nowe hasło jest wymagane',
            'min' => 'Hasło powinno składać się minimum z :min znaków',
            'different' => 'Nowe hasło nie może być takie samo jak aktualne hasło',
            'confirmed' => 'Wprowadzone przez ciebie hasła nie są identyczne',
        ],  

        'chat_view' => [
            'required' => 'Pole nowe hasło jest wymagane',
            'min' => 'Hasło powinno składać się minimum z :min znaków',
            'different' => 'Nowe hasło nie może być takie samo jak aktualne hasło',
            'confirmed' => 'Wprowadzone przez ciebie hasła nie są identyczne',
        ],  

        'lead_sound' => [
            'required' => 'Pole powtórz nowe hasło jest wymagane',
        ],

    ],

    'personal' => [

        'account_type' => [
            'required' => 'Pole rodzaj konta jest wymagane',
        ],

        'nip' => [
            'required_if' => 'Pole nip jest wymagane',
            'digits' => 'Pole nip może składać się z 10 cyfr',
        ],

        'company_name' => [
            'required_if' => 'Pole nazwa firmy jest wymagane',
            'regex' => 'Pole nazwa firmy może składać się wyłącznie ze znaków alfanumerycznych',
            'max' => 'Pole nazwa firmy może składać się maksymalnie z :max znaków',
        ],

        'pesel' => [
            'required_if' => 'Pole pesel jest wymagane',
            'digits' => 'Pole pesel może składać się z 11 cyfr',
        ],

        'first_name' => [
            'required' => 'Pole imię jest wymagane',
            'regex' => 'Pole imię może składać się wyłącznie z liter',
            'max' => 'Pole imię może składać się maksymalnie z :max znaków',
        ],

        'last_name' => [
            'required' => 'Pole nazwisko jest wymagane',
            'regex' => 'Pole nazwisko może składać się wyłącznie z liter',
            'max' => 'Pole nazwisko może składać się maksymalnie z :max znaków',
        ],

        'address' => [
            'required' => 'Pole adres jest wymagane',
            'regex' => 'Pole adres może składać się wyłącznie ze znaków alfanumerycznych.',
            'max' => 'Pole adres może składać się maksymalnie z :max znaków',
        ],

        'city' => [
            'required' => 'Pole miasto jest wymagane',
            'regex' => 'Pole miasto może składać się wyłącznie z liter',
            'max' => 'Pole miasto może składać się maksymalnie z :max znaków',
        ],

        'zip_code' => [
            'required' => 'Pole kod pocztowy jest wymagane',
            'regex' => 'Kod pocztowy musi składac się wyłącznie z cyfr oraz myślnika - format [00-000]',
        ]
    ],
];
