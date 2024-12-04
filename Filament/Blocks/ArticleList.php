<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Modules\Blog\Models\Article;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Modules\Xot\Filament\Blocks\XotBaseBlock;
use Modules\Xot\Actions\View\GetViewsSiblingsAndSelfAction;
use Modules\Xot\Actions\Filament\Block\GetViewBlocksOptionsByTypeAction;

class ArticleList extends XotBaseBlock
{

    public static function getBlockSchema(): array{
       

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
                /*
                Select::make('_tpl')
                    
                    ->options($views)
                    ->default('v1')
                    ->required(),
                */
                    ];
               
    }

   
}
