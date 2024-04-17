<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use Filament\Forms\Components\Builder;
<<<<<<< HEAD
use Modules\Blog\Filament\Blocks\DropdownMenu;
=======
use Modules\Blog\Filament\Blocks\ArticleList;
use Modules\Blog\Filament\Blocks\DropdownMenu;
use Modules\Blog\Filament\Blocks\ProfileOrLogin;
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083

class LeftSidebarContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): Builder {
        return Builder::make($name)
            ->blocks([
                DropdownMenu::make(context: $context),
<<<<<<< HEAD
=======
                ArticleList::make(context: $context),
                ProfileOrLogin::make(context: $context),
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
            ])
            ->collapsible();
    }
}
