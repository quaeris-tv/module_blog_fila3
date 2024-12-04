<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\Filament\Block\GetViewBlocksOptionsByTypeAction;
use Modules\Xot\Actions\View\GetViewsSiblingsAndSelfAction;

class ArticleList
{
    public static function make(
        string $name = 'article_list',
        string $context = 'form',
    ): Block {
        $options = app(GetViewBlocksOptionsByTypeAction::class)
            ->execute('article_list', false);

        $view = 'blog::components.blocks.article_list.v1';
        $views = app(GetViewsSiblingsAndSelfAction::class)->execute($view);

        return Block::make($name)
            ->schema([
                // Select::make('article_id')
                //    
                //    ->options(Article::published()->orderBy('title')->pluck('title', 'id'))
                //    ->required(),
                // TextInput::make('text')
                //    ,
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
                /*
                Select::make('_tpl')
                    
                    ->options($views)
                    ->default('v1')
                    ->required(),
                */
                Select::make('view')
                        ->options($options),
            ])
            
            ->columns('form' === $context ? 3 : 1);
    }
}
