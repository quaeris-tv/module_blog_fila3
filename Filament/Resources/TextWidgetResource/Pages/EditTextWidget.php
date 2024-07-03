<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\TextWidgetResource;

class EditTextWidget extends EditRecord
{
    protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
