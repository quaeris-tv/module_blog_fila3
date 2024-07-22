<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Filament\Forms\Components\Builder;
use Modules\UI\Actions\Block\GetAllBlocksAction;

class PageContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        $blocks = app(GetAllBlocksAction::class)->execute();

        $blocks = $blocks->map(
            function ($block) use ($context) {
                $class = $block->class;

                return $class::make(context: $context);
            }
        );

        return Builder::make($name)
            ->blocks($blocks->items())
            ->collapsible();
    }
}
