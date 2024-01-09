<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\Blog\Filament\Resources\PostResource;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PostResource\Widgets\PostOverview::class,
        ];
    }
}
