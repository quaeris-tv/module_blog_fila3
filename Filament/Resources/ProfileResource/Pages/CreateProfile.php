<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\CreateProfile as UserCreateProfile;

class CreateProfile extends UserCreateProfile
{
    protected static string $resource = ProfileResource::class;
}
