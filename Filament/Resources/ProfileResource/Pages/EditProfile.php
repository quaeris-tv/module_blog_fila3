<?php

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Modules\Blog\Filament\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
