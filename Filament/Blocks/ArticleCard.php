<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Blog\Models\Article;

class ArticleCard
{
    public static function make(
        string $name = 'article_card',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                Select::make('article_id')
                    
                    ->options(Article::published()->orderBy('title')->pluck('title', 'id'))
                    ->required(),

                TextInput::make('text')
                    ,
            ])
            
            ->columns('form' === $context ? 2 : 1);
    }
}
