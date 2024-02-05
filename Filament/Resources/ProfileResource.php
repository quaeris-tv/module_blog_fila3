<?php

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Blog\Models\Profile;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Modules\Blog\Filament\Resources\ProfileResource\Pages;
use Modules\Blog\Filament\Resources\ProfileResource\RelationManagers;

class ProfileResource extends XotBaseResource
{
    use Translatable;

    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('first_name'),
                Forms\Components\TextInput::make('last_name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('user.email'),
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('email'),
                TextColumn::make('credits')
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                // Tables\Actions\Action::make('getCredits')
                //     ->label('Dai Crediti')
                //     ->icon('heroicon-o-arrow-path'),
                // //     ->url(fn ($record): string => QuestionChartResource::getUrl('regen-img', ['record' => $record, ...self::$route_params])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            // 'create' => Pages\CreateProfile::route('/create'),
            // 'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
