<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\Pages;

use Filament\Actions;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Pages\ListRecords;
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
    //}

    protected function getTableColumns():array {
        $res=parent::getTableColumns();
        
        $res[]=TextColumn::make('credits');
        return $res;
    }
    
}
