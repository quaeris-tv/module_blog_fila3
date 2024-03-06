<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Modules\UI\Filament\Blocks\Title;
use Filament\Forms\Components\Builder;
use Modules\Blog\Filament\Blocks\Chart;
use Modules\Blog\Filament\Blocks\Image;
use Modules\Rating\Filament\Blocks\Rating;
use Modules\Blog\Filament\Blocks\Paragraph;
use Modules\Blog\Filament\Blocks\ImageSpatie;
use Modules\Blog\Filament\Blocks\ImagesGallery;

class ArticleContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        return Builder::make($name)
            ->blocks([
                Title::make(context: $context),
                Paragraph::make(context: $context),
                // Image::make(context: $context),
                ImageSpatie::make(context: $context),
                ImagesGallery::make(context: $context),
                Rating::make(context: $context),
                Chart::make(context: $context),
            ])
            ->collapsible();
    }
}
