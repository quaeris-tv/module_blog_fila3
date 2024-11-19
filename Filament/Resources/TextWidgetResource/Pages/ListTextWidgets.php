<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Pages\Actions;
use Modules\Blog\Filament\Resources\TextWidgetResource;
use Modules\Xot\Filament\Pages\XotBaseListRecords;

class ListTextWidgets extends XotBaseListRecords
{
    // protected static string $resource = TextWidgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
