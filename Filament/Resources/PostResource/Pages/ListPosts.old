<?php

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Modules\Blog\Filament\Resources\PostResource;
use Filament\Resources\Pages\ListRecords;
use Savannabits\FilamentModules\Concerns\ContextualPage;
use Filament\Pages\Actions;

class ListPosts extends ListRecords
{
    use ContextualPage;
    use ListRecords\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {

        
        return [
            ...parent::getActions(),
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
