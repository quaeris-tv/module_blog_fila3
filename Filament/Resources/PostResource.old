<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Modules\Blog\Filament\Resources\PostResource\Pages;
use Modules\Blog\Models\Post;
use Modules\Blog\Traits\HasContentEditor;
use Savannabits\FilamentModules\Concerns\ContextualResource;
use Filament\Resources\Concerns\Translatable;

class PostResource extends Resource
{
    use ContextualResource;
    use HasContentEditor;
    use Translatable;

    protected static ?string $model = Post::class;

    // protected static ?string $slug = 'blog/posts';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static ?int $navigationSort = 0;

    public static function getTranslatableLocales(): array
    {
        //Armeno, Italiano, Spagnolo, Francese, Inglese, Tedesco, Portoghese, Turco, Russo, Arabo, Ebraico, Cinese
        return ['en', 'es','it','de','fr','hy','zh','pt','ru','ar','he','tr'];
    }

    public static function form(Form $form): Form
    {
        //$locale = session()->get('locale') ?? request()->get('locale') ?? request()->cookie('filament_language_switch_locale') ?? config('app.locale', 'en');
        // dddx(['locale' => $locale, 'app_locale' => app()->getLocale()]);
        //App::setLocale($locale);


        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        /*
                        Forms\Components\Select::make('lang')
                            ->reactive()
                            ->options(['it' => 'it', 'en' => 'en', 'fr' => 'fr', 'de' => 'de'])
                            ->afterStateUpdated(function ($state, callable $set) {
                                App::setLocale($state);
                            })
                            ->default('it'),
                        */
                        Forms\Components\TextInput::make('title')
                            ->label(__('blog::txt.title'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state) ?? Str::uuid()))
                            ,

                        Forms\Components\TextInput::make('slug')
                            ->label(__('blog::txt.slug'))
                            ->disabled()
                            //->required()
                            //->unique(Post::class, 'slug', fn ($record) => $record)
                            ,

                        Forms\Components\Textarea::make('excerpt')
                            ->label(__('blog::txt.excerpt'))
                            ->rows(2)
                            // ->minLength(50)
                            ->maxLength(1000)
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        Forms\Components\FileUpload::make('banner')
                            ->label(__('blog::txt.banner'))
                            ->image()
                            ->maxSize(config('filament-blog.banner.maxSize', 5120))
                            ->imageCropAspectRatio(config('filament-blog.banner.cropAspectRatio', '16:9'))
                            ->disk(config('filament-blog.banner.disk', 'public'))
                            ->directory(config('filament-blog.banner.directory', 'blog'))
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        // self::getContentEditor('content'),

                        \Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor::make('content')
                        ->profile('demo')
                        ->template('icons')
                        ->required()
                        ->columnSpan([
                            'sm' => 2,
                        ]),

                        Forms\Components\BelongsToSelect::make('blog_author_id')
                            ->label(__('blog::txt.author'))
                            ->relationship('author', 'name')
                            ->searchable()
                        // ->required()
                        ,

                        Forms\Components\BelongsToSelect::make('blog_category_id')
                            ->label(__('blog::txt.category'))
                            ->relationship('category', 'name')
                            ->searchable()
                        // ->required()
                        ,

                        Forms\Components\DatePicker::make('published_at')
                            ->label(__('blog::txt.published_date')),
                        SpatieTagsInput::make('tags')
                            ->label(__('blog::txt.tags'))
                            //->required()
                            ,
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label(__('blog::txt.created_at'))
                            ->content(fn (
                                ?Post $record
                            ): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label(__('blog::txt.last_modified_at'))
                            ->content(fn (
                                ?Post $record
                            ): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('id'),
                Tables\Columns\ImageColumn::make('banner')
                    ->label(__('blog::txt.banner'))
                    ->rounded(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('blog::txt.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label(__('blog::txt.author_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('blog::txt.category_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('blog::txt.published_at'))
                    ->date(),
            ])
            ->filters([
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->placeholder(fn ($state): string => 'Dec 18, '.\now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('published_until')
                            ->placeholder(fn ($state): string => \now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),
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
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['author', 'category']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'author.name', 'category.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->author) {
            $details['Author'] = $record->author->name;
        }

        if ($record->category) {
            $details['Category'] = $record->category->name;
        }

        return $details;
    }

    public static function getPluralModelLabel(): string
    {
        return __('blog::txt.posts');
    }

    public static function getModelLabel(): string
    {
        return __('blog::txt.post');
    }
}
