<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Webmozart\Assert\Assert;
use Filament\Forms\Components\Builder;
use Modules\Xot\Datas\ComponentFileData;
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
                Assert::isInstanceOf($block, ComponentFileData::class, '['.__LINE__.']['.__FILE__.']');
                $class = $block->class;

                return $class::make(context: $context);
            }
        );
        
        /**
         * @var array<\Filament\Forms\Components\Builder\Block>
         */
        $blocks_array = $blocks->items();
        return Builder::make($name)
            ->blocks($blocks_array)
            ->collapsible();
    }
}
