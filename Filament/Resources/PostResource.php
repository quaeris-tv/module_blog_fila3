<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Blog\Models\Post;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieTagsInput;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Blog\Filament\Resources\PostResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Modules\Blog\Filament\Resources\PostResource\Filters\CategoryFilter;

class PostResource extends XotBaseResource
{
    // protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(2048)
                            ->reactive()
                            ->afterStateUpdated(static function (\Filament\Forms\Set $set, $state) {
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

                Section::make()
                    ->schema([
                        // Forms\Components\FileUpload::make('thumbnail'),
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            // ->image()
                            // ->maxSize(5000)
                            ->multiple()
                            // ->enableReordering()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull()
                            // ->collection('avatars')
                            // ->conversion('thumbnail')
                            ->disk('uploads')
                            ->directory('photos'),
                        Forms\Components\Select::make('categories')
                            ->multiple()
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
                    ])->columnSpan(4),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                // Tables\Columns\ImageColumn::make('thumbnail'),
                SpatieMediaLibraryImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(['title', 'body'])
                    ->sortable()
                    ->wrap(),
                Tables\Columns\IconColumn::make('active')
                    ->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('published_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                CategoryFilter::make(), 
            ])
            ->actions([
                //  Tables\Actions\ViewAction::make(),
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
            // 'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
