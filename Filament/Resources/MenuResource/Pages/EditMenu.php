<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\MenuResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\MenuResource;

class EditMenu extends EditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
