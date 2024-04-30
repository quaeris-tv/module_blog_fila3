<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Blog\Aggregates\ProfileAggregate;
use Modules\Blog\Datas\AddedCreditsData;
use Modules\Blog\Filament\Resources\ProfileResource\Pages;
use Modules\Blog\Models\Profile;
use Modules\User\Models\User;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\User\Filament\Resources\BaseProfileResource;

class ProfileResource extends BaseProfileResource
{
    use Translatable;

    protected static ?string $model = Profile::class;

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
            'view' => Pages\ViewProfile::route('/{record}'),
            // 'getcredits' => Pages\GetCreditProfile::route('/{record}/getcredits'),
        ];
    }
}
