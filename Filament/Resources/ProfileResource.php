<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Modules\Blog\Aggregates\ProfileAggregate;
use Modules\Blog\Datas\AddedCreditsData;
use Modules\Blog\Filament\Resources\ProfileResource\Pages;
use Modules\Blog\Models\Profile;
use Modules\User\Models\User;
use Modules\Xot\Filament\Resources\XotBaseResource;

class ProfileResource extends XotBaseResource
{
    use Translatable;

    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('user_id'),
                Forms\Components\TextInput::make('email'),
                Forms\Components\TextInput::make('first_name'),
                Forms\Components\TextInput::make('last_name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.email'),
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('email'),
                TextColumn::make('credits'),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('getCredits')
                    // ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->action(function (Profile $record, array $data) {
                        dddx('wip');
                        $added_credits_data = AddedCreditsData::from([
                            'adminId' => \Auth::user()->id,
                            'profileId' => $record->user->id,
                            'credit' => $data['credits'],
                        ]);
                        ProfileAggregate::retrieve($record->user->id)
                            ->creditAdded($added_credits_data);
                    })
                    ->form([
                        Forms\Components\TextInput::make('credits')
                            ->numeric()
                            ->label('Quanti crediti vuoi assegnare?'),
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('refresh-profiles')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $users = User::all();

                            foreach ($users as $user) {
                                Profile::firstOrCreate(
                                    ['user_id' => $user->id],
                                    ['email' => $user->email],
                                    ['credits' => 1000]
                                );
                            }
                        }),
                ]),
            ])
            ->emptyStateActions([
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
            'index' => Pages\ListProfiles::route('/'),
            // 'create' => Pages\CreateProfile::route('/create'),
            // 'edit' => Pages\EditProfile::route('/{record}/edit'),
            // 'getcredits' => Pages\GetCreditProfile::route('/{record}/getcredits'),
        ];
    }
}
