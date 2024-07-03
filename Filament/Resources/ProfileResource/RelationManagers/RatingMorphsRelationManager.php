<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ProfileResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RatingMorphsRelationManager extends RelationManager
{
    // protected static string $relationship = 'ratings';
    protected static string $relationship = 'ratingMorphs';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                // Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('rating.title'),
                // Tables\Columns\TextColumn::make('pivot.user.name'),
                /*
                Tables\Columns\TextColumn::make('user.name')->default(function($record){
                    dddx($record);
                    if($record->pivot->user_id==null){
                        return null;
                    }
                    return $record->pivot->user->name;
                }),
                //*/
                Tables\Columns\TextColumn::make('value'),
                Tables\Columns\TextColumn::make('is_winner'),
                Tables\Columns\TextColumn::make('reward'),
                Tables\Columns\TextColumn::make('updated_at'),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
