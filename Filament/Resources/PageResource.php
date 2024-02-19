<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Blog\Filament\Fields\LeftSidebarContent;
use Modules\Blog\Filament\Fields\PageContent;
use Modules\Blog\Filament\Resources\PageResource\Pages;
use Modules\Blog\Models\Page;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;
use Pboivin\FilamentPeek\Tables\Actions\ListPreviewAction;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $navigationGroup = 'Site';

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
                    ->required()
                    ->columnSpan(1)
                    ->afterStateUpdated(static fn ($set, $state) => $set('slug', Str::slug($state))),
            ]),

            Forms\Components\Actions::make([
                InlinePreviewAction::make()
                    ->label('Open Content Editor')
                    ->builderName('content'),
            ])
                ->columnSpanFull()
                ->alignEnd(),

            Forms\Components\Section::make('Page Content')->schema([
                PageContent::make('content_blocks')
                    ->label('Blocchi Contenuto')
                    ->required()
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Sidebar Content')->schema([
                LeftSidebarContent::make('sidebar_blocks')
                    ->label('Blocchi Sidebar')
                    // ->required()
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    ListPreviewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->filters([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
