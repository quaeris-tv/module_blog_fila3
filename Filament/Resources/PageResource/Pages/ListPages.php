<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PageResource\Pages;

use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Filament\Resources\PageResource;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class ListPages extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    use HasPreviewModal;

    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            CreateAction::make(),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'page.show';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'page';
    }
}
