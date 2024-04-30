<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Modules\Blog\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\ViewProfile as UserViewProfile;

class ViewProfile extends UserViewProfile
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
