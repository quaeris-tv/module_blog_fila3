<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord;

class CreateArticle extends XotBaseCreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
