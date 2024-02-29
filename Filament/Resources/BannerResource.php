<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Blog\Models\Banner;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use Modules\Blog\Filament\Resources\BannerResource\Pages;

class BannerResource extends XotBaseResource
{
    use NavigationLabelTrait;
    use Translatable;
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getTranslatableLocales(): array
    {
        return ['it', 'en'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Grid::make()->columns(2)->schema([
                    Forms\Components\TextInput::make('title')
                        ->columnSpan(1)
                        ->required(),
                    Forms\Components\TextInput::make('short_description')
                        ->columnSpan(1)
                        ->required(),
                ])
            ]);
        }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
