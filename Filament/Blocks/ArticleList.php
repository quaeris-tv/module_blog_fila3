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
                //Select::make('article_id')
                //    ->label('Article')
                //    ->options(Article::published()->orderBy('title')->pluck('title', 'id'))
                //    ->required(),
                //TextInput::make('text')
                //    ->label('Link text (optional)'),
                Select::make('type')
                    ->label('Type')
                    ->options([
                        'latest'=>'latest',
                        'featured'=>'featured'
                    ])
                    ->required(),
                TextInput::make('limit'),

            ])
            ->label('article list')
            ->columns('form' === $context ? 2 : 1);
    }
}
