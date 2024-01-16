<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\PageResource;

class EditPage extends EditRecord
{
    use PageResource\Pages\HasPagePreview;

    protected static string $resource = PageResource::class;
}
