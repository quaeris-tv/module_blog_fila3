<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Filament\Tables\Columns\TextColumn;
use Modules\Blog\Filament\Actions\Profile\ModifyCredits;
use Modules\Blog\Filament\Resources\ProfileResource;
use Modules\User\Filament\Resources\BaseProfileResource\Pages\ListProfiles as UserListProfiles;

class ListProfiles extends UserListProfiles
{
    protected static string $resource = ProfileResource::class;

    // protected function getHeaderActions(): array
    // {
    //    return [
    //        Actions\CreateAction::make(),
    //    ];
    // }

    protected function getTableColumns(): array
    {
        $res = parent::getTableColumns();

        $res[] = TextColumn::make('credits');

        return $res;
    }

    protected function getTableActions(): array
    {
        $res = parent::getTableActions();

        // $res[] = ModifyCredits::make();

        return $res;
    }
}
