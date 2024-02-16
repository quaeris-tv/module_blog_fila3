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
                    ->helperText('Inserisci un sotto titolo del blocco articoli'),
                Select::make('type')
                    ->label('Type')
                    ->options([
                        'latest' => 'latest',
                        'featured' => 'featured',
                    ])
                    ->required(),
                TextInput::make('limit'),
                Select::make('layout')
                ->label('layout')
                ->options([
                    'v1' => 'layout 1 (Tailwind)',
                    'v2' => 'layout 2 (Tailwind)',
                    'v3' => 'layout 3 (Tailwind)',
                    'v4' => 'layout 4 (Tailwind)',
                    'v5' => 'layout 5 (Tailwind)',
                    'v6' => 'layout 6 (Tailwind)',
                    'v7' => 'layout 7 (Bootstrap)',
                ])
                ->default('v1')
                ->required(),
            ])
            ->label('article list')
            ->columns('form' === $context ? 3 : 1);
    }
}
