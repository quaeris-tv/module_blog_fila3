<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Blog\Models\Article;

class ArticleList
{
    public static function make(
        string $name = 'article_list',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                // Select::make('article_id')
                //    ->label('Article')
                //    ->options(Article::published()->orderBy('title')->pluck('title', 'id'))
                //    ->required(),
                // TextInput::make('text')
                //    ->label('Link text (optional)'),
                TextInput::make('title')
                ->label('Titolo')
                ->helperText('Inserisci un titolo del blocco articoli')
                ->required(),
                TextInput::make('sub_title')
                    ->label('Sotto Titolo')
                    ->helperText('Inserisci un sotto_titolo del blocco articoli'),
                Select::make('type')
                    ->label('Type')
                    ->options([
                        'latest' => 'latest',
                        'featured' => 'featured',
                    ])
                    ->required(),
                TextInput::make('limit'),
                Select::make('version')
                ->label('version')
                ->options([
                    'v1' => 'versione 1',
                    'v2' => 'versione 2',
                    'v3' => 'versione 3',
                    'v4' => 'versione 4',
                    'v5' => 'versione 5',
                ])
                ->required(),
            ])
            ->label('article list')
            ->columns('form' === $context ? 3 : 1);
    }
}
