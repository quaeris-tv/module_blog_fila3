<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ContactEntryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\ContactEntryResource;

class CreateContactEntry extends CreateRecord
{
    protected static string $resource = ContactEntryResource::class;
}
