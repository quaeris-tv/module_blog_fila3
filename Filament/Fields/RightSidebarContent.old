<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Filament\Forms\Components\Builder;
use Modules\Rating\Filament\Blocks\Rating;

class RightSidebarContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        return Builder::make($name)
            ->blocks([
                Rating::make(context: $context),
            ])
            ->collapsible();
    }
}
