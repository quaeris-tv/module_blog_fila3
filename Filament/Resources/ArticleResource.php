<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Blog\Filament\Fields\ArticleContent;
use Modules\Blog\Filament\Fields\ArticleFooter;
use Modules\Blog\Filament\Fields\ArticleSidebar;
use Modules\Blog\Filament\Resources\ArticleResource\Pages;
use Modules\Blog\Filament\Resources\ArticleResource\RelationManagers;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ArticleResource extends XotBaseResource
{
    use Translatable;

    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    // protected static ?string $navigationIcon = 'icon-article';

    public static function getTranslatableLocales(): array
    {
        return ['it', 'en'];
    }

    public static function getFormFields(): array
    {
        return [
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
                Forms\Components\DateTimePicker::make('closed_at')
                    ->columnSpan(1)
                    ->helperText('Determina fino a quando è possibile scommettere')
                    ->required(),
                /*
                Forms\Components\TextInput::make('description')
                    ->columnSpanFull()
                    ->required()
                    ->helperText('Una breve descrizione dell\'articolo'),
                */
                Forms\Components\DateTimePicker::make('published_at')
                    ->columnSpan(1)
                    ->nullable()
                // ->required()
                ,
                Forms\Components\DateTimePicker::make('rewarded_at')
                    ->nullable()
                    ->columnSpan(1),

                /*
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->columnSpan(1)
                    ->required(),
                */
                Forms\Components\Select::make('category_id')
                            // ->multiple()
                    ->required()
                     // ->relationship('categories', 'title')
                    // ->relationship('category', 'title')
                    ->options(Category::getTreeCategoryOptions())
                    ->createOptionForm(CategoryResource::getFormFields()),
                SpatieTagsInput::make('tags'),
                Forms\Components\Toggle::make('is_featured')
                    ->columnSpanFull()
                // ->required()
                ,
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
                    ->label('Content')
                    ->required()
                    ->columnSpanFull(),
            ])->collapsible(),

            Forms\Components\Section::make('Article Sidebar')->schema([
                Forms\Components\Actions::make([
                    /*
                    InlinePreviewAction::make()
                        ->label('Preview Content Blocks')
                        ->builderName('content_blocks'),
                    */
                ])
                    ->columnSpanFull()
                    ->alignRight(),

                ArticleSidebar::make('sidebar_blocks')
                    ->label('Sidebar')
                    // ->required()
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
                    ->label('Footer')
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
                ->directory('photos')
                ->collection('main_image_upload')
            // ->preserveFilenames()
            ,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema(static::getFormFields());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('closed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rewarded_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->sortable(),

                // Tables\Columns\TextColumn::make('id')
                //     ->label('My Status')
                //     ->formatStateUsing(function ($state, Article $article) {
                //         return $article->title . ' ' . $article->category->title;
                //     }),

                // Tables\Columns\ViewColumn::make('info')
                //     ->view('blog::filament.tables.columns.article.info'),
                // Tables\Columns\ViewColumn::make('status')
                //     ->view('blog::filament.tables.columns.article.status'),

                // Tables\Columns\Layout\Split::make([
                //     // Tables\Columns\TextColumn::make('id'),
                //     Tables\Columns\TextColumn::make('title')
                //         ->sortable()
                //         ->searchable(),

                //     Tables\Columns\TextColumn::make('category.title')
                //         ->sortable()
                //         ->searchable(),
                // ]),
                // Tables\Columns\Layout\Split::make([
                //     Tables\Columns\TextColumn::make('published_at')
                //         ->dateTime()
                //         ->sortable(),
                //     Tables\Columns\TextColumn::make('closed_at')
                //         ->dateTime()
                //         ->sortable(),
                //     Tables\Columns\IconColumn::make('is_featured')
                //         ->boolean()
                //         ->sortable(),
                // ]),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('is_featured')->toggle(),
                Tables\Filters\SelectFilter::make('Categoria')
                    ->options(Category::getTreeCategoryOptions())
                    ->attribute('category_id'),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RatingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
            'view' => Pages\ViewArticle::route('/{record}'),
        ];
    }
}
