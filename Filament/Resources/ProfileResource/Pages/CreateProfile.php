<?php

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Modules\Blog\Filament\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;
}
