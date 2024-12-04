<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\TextInput;
use Modules\Xot\Filament\Blocks\XotBaseBlock;

class ArticleList extends XotBaseBlock
{
    public static function getBlockSchema(): array
    {
        return [
            TextInput::make('title')

                ->helperText('Inserisci un titolo del blocco articoli')
                ->required(),
            TextInput::make('sub_title')

                ->helperText('Inserisci un sotto titolo del blocco articoli'),
            TextInput::make('method')

                ->hint('Inserisci il nome del metodo da richiamare nel tema')
                ->required(),
            /*
                Select::make('type')

                    ->options([
                        'latest' => 'latest',
                        'featured' => 'featured',
                    ])
                    ->required(),
                */
            TextInput::make('limit'),
        ];
    }
}
