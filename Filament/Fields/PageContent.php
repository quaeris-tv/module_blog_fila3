<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Filament\Forms\Components\Builder;
use Illuminate\Support\Arr;
use Modules\Blog\Actions\Block\GetAllBlocksAction;

class PageContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        $blocks = app(GetAllBlocksAction::class)->execute();

        $blocks = Arr::map($blocks, function ($block) use ($context) {
            $class = $block['class'];

            return $class::make(context: $context);
        });

        return Builder::make($name)
            ->blocks($blocks)
            ->collapsible();
    }
}
