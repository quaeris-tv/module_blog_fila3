<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
<<<<<<< HEAD
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
=======
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
>>>>>>> dev
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
<<<<<<< HEAD
use Modules\Blog\Filament\Resources\PostResource\Filters\CategoryFilter;
use Modules\Blog\Filament\Resources\PostResource\Pages;
use Modules\Blog\Models\Post;
use Modules\Xot\Filament\Resources\XotBaseResource;

class PostResource extends XotBaseResource
{
    // protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static ?string $navigationGroup = 'Content';
=======
use Modules\Blog\Filament\Resources\PostResource\Pages;
use Modules\Blog\Models\Post;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';
>>>>>>> dev

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
<<<<<<< HEAD
                Section::make()
=======
                Forms\Components\Card::make()
>>>>>>> dev
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(2048)
                            ->reactive()
<<<<<<< HEAD
                            ->afterStateUpdated(static function (\Filament\Forms\Set $set, $state) {
=======
                            ->afterStateUpdated(function (\Filament\Forms\Set $set, $state) {
>>>>>>> dev
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(2048),
                        Forms\Components\RichEditor::make('body')
                            ->required(),
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('active')
                            ->required(),
                        Forms\Components\DateTimePicker::make('published_at'),
                    ])->columnSpan(8),

<<<<<<< HEAD
                Section::make()
=======
                Forms\Components\Card::make()
>>>>>>> dev
                    ->schema([
                        // Forms\Components\FileUpload::make('thumbnail'),
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            // ->image()
                            // ->maxSize(5000)
<<<<<<< HEAD
                            ->multiple()
                            // ->enableReordering()
                            ->openable()
                            ->downloadable()
=======
                            // ->multiple()
                            // ->enableReordering()
                            ->enableOpen()
                            ->enableDownload()
>>>>>>> dev
                            ->columnSpanFull()
                            // ->collection('avatars')
                            // ->conversion('thumbnail')
                            ->disk('uploads')
                            ->directory('photos'),
                        Forms\Components\Select::make('categories')
<<<<<<< HEAD
                            // ->multiple()
                            ->required()
                            ->relationship('categories', 'title')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                // Forms\Components\TextInput::make('email')
                                //    ->required()
                                //    ->email(),
                            ]),
                        SpatieTagsInput::make('tags'),
=======
                            ->multiple()
                            ->relationship('categories', 'title'),
>>>>>>> dev
                    ])->columnSpan(4),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< HEAD
                Tables\Columns\TextColumn::make('id'),
                // Tables\Columns\ImageColumn::make('thumbnail'),
                SpatieMediaLibraryImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(['title', 'body'])
                    ->sortable()
                    ->wrap(),
=======
                // Tables\Columns\ImageColumn::make('thumbnail'),
                SpatieMediaLibraryImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('title')->searchable(['title', 'body'])->sortable(),
>>>>>>> dev
                Tables\Columns\IconColumn::make('active')
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
<<<<<<< HEAD
                CategoryFilter::make(),
            ])
            ->actions([
                //  Tables\Actions\ViewAction::make(),
=======
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
>>>>>>> dev
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
<<<<<<< HEAD
            // 'view' => Pages\ViewPost::route('/{record}'),
=======
            'view' => Pages\ViewPost::route('/{record}'),
>>>>>>> dev
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
