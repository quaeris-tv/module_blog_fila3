<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Filament\Resources\CategoryResource;

class ListCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
