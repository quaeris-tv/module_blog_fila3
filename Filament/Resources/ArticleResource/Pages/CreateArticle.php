<?php

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Modules\Blog\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
