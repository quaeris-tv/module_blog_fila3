<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\Blog\Actions\Article\ImportArticlesFromByJsonTextAction;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Blog\Models\Category;
use Modules\Xot\Filament\Pages\XotBaseListRecords;

class ListArticles extends XotBaseListRecords
{
    use ListRecords\Concerns\Translatable;

    // protected static string $resource = ArticleResource::class;

    public function getListTableColumns(): array
    {
        return
        [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('title')
                ->wrap()
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
        ];
    }

    public function getTableActions(): array
    {
        return [
            /*
            Tables\Actions\ActionGroup::make([
                ListPreviewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]),
            */
            Tables\Actions\EditAction::make()->label(''),
            Tables\Actions\ViewAction::make()->label(''),
            Tables\Actions\DeleteAction::make()->label(''),
        ];
    }

    public function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }

    public function getTableFilters(): array
    {
        return [
            Tables\Filters\Filter::make('is_featured')->toggle(),
            Tables\Filters\SelectFilter::make('Categoria')
                ->options(Category::getTreeCategoryOptions())
                ->attribute('category_id'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->layoutView->getTableColumns())
            ->contentGrid($this->layoutView->getTableContentGrid())
            ->headerActions($this->getTableHeaderActions())
            ->filters($this->getTableFilters())
            ->bulkActions($this->getTableBulkActions())
            ->actionsPosition(ActionsPosition::BeforeColumns)
            ->actions($this->getTableActions())
            ->defaultSort('published_at', 'desc');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
            Actions\Action::make('import')
                ->form([
                    FileUpload::make('file')
                        ->label('')
                        // ->acceptedFileTypes(['application/json', 'json'])
                        ->imagePreviewHeight('250')
                        ->reactive()
                        ->afterStateUpdated(static function (callable $set, TemporaryUploadedFile $state): void {
                            $set('fileContent', File::get($state->getRealPath()));
                        }),
                    Textarea::make('fileContent'),
                ])
                ->label('')
                ->tooltip('Import')
                ->icon('heroicon-o-folder-open')
                ->action(static fn (array $data) => app(ImportArticlesFromByJsonTextAction::class)->execute($data['fileContent'])),
        ];
    }
}
