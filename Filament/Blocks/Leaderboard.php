<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Xot\Actions\View\GetViewsSiblingsAndSelfAction;

class Leaderboard
{
    public static function make(
        string $name = 'leaderboard',
        string $context = 'form',
    ): Block {
        $view = 'blog::components.blocks.leaderboard.v1';
        $views = app(GetViewsSiblingsAndSelfAction::class)->execute($view);

        return Block::make($name)
            ->schema([
                TextInput::make('title')

                    ->helperText('Inserisci un titolo della classifica')
                    ->required(),
                TextInput::make('sub_title')

                    ->helperText('Inserisci un sotto titolo della classifica'),
                // Select::make('type')
                //
                //     ->options([
                //         'latest' => 'latest',
                //         // 'featured' => 'featured',
                //     ])
                //     ->required(),
                TextInput::make('limit'),
                // Select::make('version')
                //
                // ->options([
                //     'v1' => 'versione 1 (Tailwind)',
                //     'v2' => 'versione 2 (Bootstrap)',
                //     // 'v3' => 'versione 3',
                //     // 'v4' => 'versione 4',
                //     // 'v5' => 'versione 5',
                // ]),

                Select::make('_tpl')

                    ->options($views)
                    ->default('v1')
                    ->required(),

                // ->required(),
            ])

            ->columns('form' === $context ? 3 : 1);
    }
}
