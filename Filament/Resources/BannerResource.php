<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Modules\Blog\Filament\Resources\BannerResource\Pages;
use Modules\Blog\Models\Banner;
use Modules\Blog\Models\Category;
use Modules\Xot\Filament\Resources\XotBaseResource;

class BannerResource extends XotBaseResource
{
    // use Translatable;
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'ui-starbanner';

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
                        ->label(static::trans('fields.title'))
                        ->columnSpan(1)
                        ->required(),
                    Forms\Components\TextInput::make('description')
                        ->columnSpan(1)
                        ->required(),
                    // Forms\Components\TextInput::make('action_text')
                    //     ->columnSpan(1)
                    //     ->required(),
                    Forms\Components\Select::make('category_id')
                        ->required()
                        ->options(Category::getTreeCategoryOptions()),
                    // Forms\Components\TextInput::make('link')
                    //     ->columnSpan(1)
                    // ->required(),
                    // ->helperText('bla bla bla'),
                    // Forms\Components\DateTimePicker::make('start_date')
                    //     ->columnSpan(1),
                    // Forms\Components\DateTimePicker::make('end_date')
                    //     ->columnSpan(1),
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
                        ->collection('banner'),

                    // 'open_markets_count', // : 119,
                ]),
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             Tables\Columns\TextColumn::make('id')
    //                 ->label(static::trans('fields.id'))
    //                 ->sortable()
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('title')
    //                 ->label(static::trans('fields.title'))
    //                 ->sortable()
    //                 ->searchable(),
    //             Tables\Columns\TextColumn::make('category.title')
    //                 ->label(static::trans('fields.category.title'))
    //                 ->sortable()
    //                 ->searchable(),
    //             SpatieMediaLibraryImageColumn::make('image')
    //                 ->label(static::trans('fields.image'))
    //                 ->collection('banner'),
    //         ])
    //         ->filters([
    //         ])
    //         ->actions([
    //             Tables\Actions\EditAction::make(),
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ])
    //         ->emptyStateActions([
    //         ])
    //         ->reorderable('pos')
    //         ->defaultSort('pos', 'asc');
    // }

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
