<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'username' => [
        'required' => 'Pole nazwa użytkownika jest wymagane',
        'alpha_num' => 'Nazwa użytkownika powinna składać się wyłącznie z liter i cyfr.',
        'min' => 'Nazwa użytkownika powinna składać się minimum z 5 znaków.',
        'max' => 'Nazwa użytkownika powinna składa się maksymalnie z 32 znaków.',
        'unique' => 'unique',
    ],

    'password' => [
        'required' => 'Pole hasło jest wymagane',
        'min' => 'Hasło powinno składać się minimum z 5 znakó.',
    ],

    'password_confirmation' => [
        'required' => 'Pole powtórz hasło jest wymagane.',
        'confirmed' => 'confirmed',
    ],

    'email' => [
        'required' => 'Pole adres email jest wymagane.',
        'email' => 'email',
        'unique' => 'unique',
    ],

    'g-recaptcha-response' => [
        'required' => 'ww',
    ],

    'signin' => [
        'banned' => 'Twoje konto zostało zablokowane przez administratora!',
        'notactivate' => 'Twoje konto wymaga aktywacji! Sprawdź pocztę.',
        'failed' => 'Nazwa użytkownika lub hasło jest nieprawidłowe!',
        'limit' => 'Przekroczono limit prób logowania! Spróbuj ponownie za :seconds sekund!',
    ],

    'accountactivate' => [
        'success' => 'Twoje konto zostało pomyślnie aktywowane! Teraz możesz zalogować się.',
        'failed' => 'Link aktywujący konto jest nieprawidłowy lub twoje konto zostało już aktywowane!',
    ],

    'passwordreset' => [
        'success' => 'Hasło zostało zresetowane pomyślnie! Na adres email wysłaliśmy wiadomość z nowym hasłem.',
        'failed' => 'Link resetujący hasło jest nieprawidłowy!',
    ],

    'passwordforgot' => [
        'limit' => 'Resetować hasło możesz raz na 15 minut!',
        'notactivate' => 'Aktywuj konto w celu zresetowania hasła!',
        'success' => 'Proces resetowania hasła przebiega pomyślnie! Na adres email wysłaliśmy wiadomość z linkiem resetującym.',
        'failed' => 'Nazwa użytkownika lub adres email jest nieprawidłowy!',
    ],

    'signup' =>[
        'success' => 'Rejestracja przebiegła pomyślnie! Na adres email wysłaliśmy wiadomość z linkiem aktywacyjnym!',
        'failed' => 'Wystąpił nieoczekiwany błąd podczas tworzenia konta! Spróbuj ponownie za chwilę.',
    ],

    'signout' => 'Zostałeś pomyślnie wylogowany!',

];
