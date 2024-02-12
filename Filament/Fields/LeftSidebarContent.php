<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Filament\Forms\Components\Builder;
use Modules\Blog\Filament\Blocks\Chart;
use Modules\Blog\Filament\Blocks\Image;
use Modules\Blog\Filament\Blocks\Title;
use Modules\Rating\Filament\Blocks\Rating;
use Modules\Blog\Filament\Blocks\Paragraph;
use Modules\Blog\Filament\Blocks\ArticleList;
use Modules\Blog\Filament\Blocks\Leaderboard;
use Modules\Blog\Filament\Blocks\DropdownMenu;
use Modules\Blog\Filament\Blocks\ImagesGallery;

class LeftSidebarContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        return Builder::make($name)
            ->blocks([
                DropdownMenu::make(context: $context),
            ])
            ->collapsible();
    }
}
