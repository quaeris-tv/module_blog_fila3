<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Filament\Forms\Components\Builder;
use Modules\Blog\Filament\Blocks\ArticleCard;
use Modules\Blog\Filament\Blocks\ImageSpatie;
use Modules\Blog\Filament\Blocks\PageCard;

class ArticleFooter
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        return Builder::make($name)
            ->blocks([
                ArticleCard::make(context: $context),
                PageCard::make(context: $context),
                ImageSpatie::make(context: $context),
            ])
            ->collapsible();
    }
}
