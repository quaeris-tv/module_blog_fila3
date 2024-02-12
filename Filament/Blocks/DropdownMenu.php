<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Builder\Block;

class DropdownMenu
{
    public static function make(
        string $name = 'dropdown_menu',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                Repeater::make('menu')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        Select::make('type')
                            ->label('Cosa vuoi visualizzare')
                            ->options([
                                'categories' => 'Categorie',
                            ])
                            ->required(),
                    ])->columnSpanFull(),
            ]);
    }
}
