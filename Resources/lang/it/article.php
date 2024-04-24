<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;

return [
    'navigation' => [
        'name' => 'Articolo',
        'plural' => 'Articoli',
        'group' => [
            'name' => 'Content',
        ],
    ],

    'rating' => [
        'no_import' => 'Nessuna cifra scelta',
        'import_zero' => 'Nessuna cifra scelta',
        'import_min' => 'Hai superato la cifra di '.Auth::user()->profile->credits.' crediti',
        'no_choice' => 'Nessuna opzione scelta'
    ],


    // 'fields' => [
    //     'name' => 'Nome',
    //     'guard_name' => 'Guard',
    //     'permissions' => 'Permessi',
    //     'roles' => 'Ruoli',
    //     'updated_at' => 'Aggiornato il',
    //     'first_name' => 'Nome',
    //     'last_name' => 'Cognome',
    // ],
    // 'actions' => [
    //     'import' => [
    //         'fields' => [
    //             'import_file' => 'Seleziona un file XLS o CSV da caricare',
    //         ],
    //     ],
    //     'export' => [
    //         'filename_prefix' => 'Aree al',
    //         'columns' => [
    //             'name' => 'Nome area',
    //             'parent_name' => 'Nome area livello superiore',
    //         ],
    //     ],
    // ],
];
