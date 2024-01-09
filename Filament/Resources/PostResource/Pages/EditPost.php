<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PostResource\Pages;

<<<<<<< HEAD
use Filament\Actions;
=======
use Filament\Pages\Actions;
>>>>>>> dev
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\PostResource;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
<<<<<<< HEAD
=======
            Actions\ViewAction::make(),
>>>>>>> dev
            Actions\DeleteAction::make(),
        ];
    }
}
