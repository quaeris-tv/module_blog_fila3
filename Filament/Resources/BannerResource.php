<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Modules\Blog\Models\Banner;
use Filament\Resources\Resource;
use Modules\Blog\Models\Category;
use Filament\Resources\Concerns\Translatable;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use Modules\Blog\Filament\Resources\BannerResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class BannerResource extends XotBaseResource
{
    use NavigationLabelTrait;
    // use Translatable;
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // public static function getTranslatableLocales(): array
    // {
    //     return ['it', 'en'];
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Grid::make()->columns(2)->schema([
                    Forms\Components\TextInput::make('title')
                        ->columnSpan(1)
                        ->required(),
                    Forms\Components\TextInput::make('description')
                        ->columnSpan(1)
                        ->required(),
                    Forms\Components\TextInput::make('action_text')
                        ->columnSpan(1)
                        ->required(),
                    Forms\Components\Select::make('category_id')
                        ->required()
                        ->options(Category::getTreeCategoryOptions()),
                    Forms\Components\TextInput::make('link')
                        ->columnSpan(1)
                        ->required(),
                    Forms\Components\DateTimePicker::make('start_date')
                        ->columnSpan(1),
                    Forms\Components\DateTimePicker::make('end_date')
                        ->columnSpan(1),
                    Forms\Components\Toggle::make('hot_topic')
                        ->columnSpan(1),
                    Forms\Components\Toggle::make('landing_banner')
                        ->columnSpan(1),

                    SpatieMediaLibraryFileUpload::make('image')
                        // ->image()
                        // ->maxSize(5000)
                        // ->multiple()
                        // ->enableReordering()
                        ->openable()
                        ->downloadable()
                        ->columnSpanFull()
                        // ->collection('avatars')
                        // ->conversion('thumbnail')
                        ->disk('uploads')
                        ->directory('photos')
                        ->collection('banner')


                        // 'open_markets_count', // : 119,
                ])
            ]);
        }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
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