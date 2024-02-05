<?php

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Modules\Blog\Filament\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfiles extends ListRecords
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
