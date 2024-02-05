<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\ProfileResource;

class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;
}
