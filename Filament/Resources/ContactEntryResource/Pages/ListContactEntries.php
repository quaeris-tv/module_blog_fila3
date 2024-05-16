<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ContactEntryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Filament\Resources\ContactEntryResource;

class ListContactEntries extends ListRecords
{
    protected static string $resource = ContactEntryResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
