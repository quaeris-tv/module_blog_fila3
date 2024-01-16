<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\PageResource;

class CreatePage extends CreateRecord
{
    use PageResource\Pages\HasPagePreview;

    protected static string $resource = PageResource::class;
}
