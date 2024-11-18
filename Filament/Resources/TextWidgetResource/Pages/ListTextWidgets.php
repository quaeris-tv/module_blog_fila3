<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\TextWidgetResource\Pages;

use Filament\Pages\Actions;
use Modules\Xot\Filament\Pages\XotBaseListRecords;
use Modules\Blog\Filament\Resources\TextWidgetResource;

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
