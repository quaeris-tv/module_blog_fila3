<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class Filter
{
    public static function make(
        string $name = 'filter',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                // TextInput::make('title')
                //
                //     ->helperText('Inserisci un titolo della classifica')
                //     ->required(),
                // TextInput::make('sub_title')
                //
                //     ->helperText('Inserisci un sotto titolo della classifica'),
                // Select::make('type')
                //
                //     ->options([
                //         'latest' => 'latest',
                //         // 'featured' => 'featured',
                //     ])
                //     ->required(),
                // TextInput::make('limit'),
                Select::make('layout')

                    ->options([
                        'v1' => 'layout 1 (bootstrap)',
                        // 'v2' => 'versione 2',
                        // 'v3' => 'versione 3',
                        // 'v4' => 'versione 4',
                        // 'v5' => 'versione 5',
                    ]),
                // ->required(),
            ])

            ->columns('form' === $context ? 3 : 1);
    }
}
