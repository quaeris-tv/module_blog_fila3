<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

<<<<<<< HEAD
use Filament\Actions;
=======
use Filament\Pages\Actions;
>>>>>>> dev
use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Filament\Resources\PostResource;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
