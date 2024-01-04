<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ContactEntryResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\ContactEntryResource;

class EditContactEntry extends EditRecord
{
    protected static string $resource = ContactEntryResource::class;

    protected function getActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
