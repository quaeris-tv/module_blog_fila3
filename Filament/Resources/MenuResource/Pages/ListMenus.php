<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\MenuResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Filament\Resources\MenuResource;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
