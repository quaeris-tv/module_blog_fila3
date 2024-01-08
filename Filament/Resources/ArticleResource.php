<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Blog\Filament\Fields\ArticleContent;
use Modules\Blog\Filament\Fields\ArticleFooter;
use Modules\Blog\Filament\Resources\ArticleResource\Pages;
use Modules\Blog\Models\Article;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ArticleResource extends XotBaseResource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make()->columns(2)->schema([
                Forms\Components\TextInput::make('title')
                    ->columnSpan(1)
                    ->required()
                    ->lazy()
                    ->afterStateUpdated(static function ($set, $get, $state) {
                        if ($get('slug')) {
                            return;
                        }
                        $set('slug', Str::slug($state));
                    }),

                Forms\Components\TextInput::make('slug')
                    ->columnSpan(1)
                    ->required(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->columnSpan(1),

                /*
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->columnSpan(1)
                    ->required(),
                */
                Forms\Components\Select::make('categories')
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
                Forms\Components\Toggle::make('is_featured')
                    ->columnSpanFull()
                    ->required(),
            ]),

            Forms\Components\Section::make('Article Content')->schema([
                Forms\Components\Actions::make([
                    /*
                    InlinePreviewAction::make()
                        ->label('Preview Content Blocks')
                        ->builderName('content_blocks'),
                    */
                ])
                    ->columnSpanFull()
                    ->alignRight(),

                ArticleContent::make('content_blocks')
                    ->label('Blocks')
                    ->columnSpanFull(),
            ])->collapsible(),

            Forms\Components\Section::make('Article Footer')->schema([
                Forms\Components\Actions::make([
                    /*
                    InlinePreviewAction::make()
                        ->label('Open Footer Editor')
                        ->builderName('footer_blocks'),
                    */
                ])
                    ->columnSpanFull()
                    ->alignRight(),

                ArticleFooter::make('footer_blocks')
                    ->label('Blocks')
                    ->columnSpanFull(),
            ])->collapsible(),

            Forms\Components\TextInput::make('main_image_url')
                ->label('Main image URL')
                ->columnSpanFull(),

            // Forms\Components\FileUpload::make('main_image_upload')
            //     ->label('Main image upload')
            //     ->columnSpanFull(),
            SpatieMediaLibraryFileUpload::make('main_image_upload')
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
                ->directory('photos'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('categories.title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->sortable(),
            ])
            ->actions([
                /*
                Tables\Actions\ActionGroup::make([
                    ListPreviewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
                */
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                /*
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                */
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
