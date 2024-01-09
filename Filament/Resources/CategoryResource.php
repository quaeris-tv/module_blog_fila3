<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
<<<<<<< HEAD
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
=======
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
>>>>>>> dev
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Blog\Filament\Resources\CategoryResource\Pages;
use Modules\Blog\Models\Category;
<<<<<<< HEAD
use Modules\Xot\Filament\Resources\XotBaseResource;

class CategoryResource extends XotBaseResource
{
    // protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $navigationGroup = 'Content';
=======

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content';
>>>>>>> dev

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(2048)
                    ->reactive()
<<<<<<< HEAD
                    ->unique()
                // ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                //     $set('slug', Str::slug($state));
                // })
                ,
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(2048),
                SpatieMediaLibraryFileUpload::make('image')
                    // ->image()
                    // ->maxSize(5000)
                    // ->multiple()
                    // ->enableReordering()
                    ->enableOpen()
                    ->enableDownload()
                    ->columnSpanFull()
                    // ->collection('avatars')
                    // ->conversion('thumbnail')
                    ->disk('uploads')
                    ->directory('photos'),
=======
                    ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(2048),
>>>>>>> dev
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->dateTime(),
<<<<<<< HEAD
                SpatieMediaLibraryImageColumn::make('image'),
=======
>>>>>>> dev
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategories::route('/'),
        ];
    }
}
