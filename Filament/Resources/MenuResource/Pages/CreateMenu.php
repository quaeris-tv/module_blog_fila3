<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\MenuResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\MenuResource;

class CreateMenu extends CreateRecord
{
    protected static string $resource = MenuResource::class;
}
