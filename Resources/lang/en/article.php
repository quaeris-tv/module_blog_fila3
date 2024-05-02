<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Modules\Blog\Models\Profile;
use Webmozart\Assert\Assert;

Assert::notNull($user = Auth::user());
Assert::notNull($profile = $user->profile);
Assert::isInstanceOf($profile, Profile::class);

return [
    'navigation' => [
        'name' => 'Article',
        'plural' => 'Articles',
        'group' => [
            'name' => 'Content',
        ],
    ],

    'rating' => [
        'no_import' => 'No digits entered',
        'import_zero' => 'No digits entered',
        'import_min' => 'You have exceeded the amount of '.$profile->credits.' credits',
        'no_choice' => 'No option chosen',
    ],

    'expired' => 'Item has expired, no more bets can be placed',

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
