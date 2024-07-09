<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Modules\Blog\Filament\Resources\CategoryResource;

class ListCategories extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }

    public function getTableColumns(): array
    {
        return [
            Tables\Columns\IconColumn::make('icon')
                ->icon(fn ($state) => $state),
            Tables\Columns\TextColumn::make('title')->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('parent.title')->searchable()
                ->sortable(),
            // Tables\Columns\TextColumn::make('updated_at')
            //     ->sortable()
            //     ->dateTime(),
            SpatieMediaLibraryImageColumn::make('image'),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
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
}
