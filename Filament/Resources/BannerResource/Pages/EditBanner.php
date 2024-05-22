<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\BannerResource;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
