<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Modules\User\Models\User;
use Modules\Blog\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Modules\Blog\Datas\AddedCreditsData;
use Illuminate\Database\Eloquent\Collection;
use Filament\Resources\Concerns\Translatable;
use Modules\Blog\Aggregates\ProfileAggregate;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Modules\Blog\Filament\Resources\ProfileResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

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
                SpatieMediaLibraryFileUpload::make('photo_profile')
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
                    ->collection('photo_profile')
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
                SpatieMediaLibraryImageColumn::make('photo_profile')
                    ->collection('photo_profile')
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                /* ---deve essere uno scherzone
                Tables\Actions\Action::make('getCredits')
                    // ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->action(function (Profile $record, array $data) {
                        dddx('wip');
                        $added_credits_data = AddedCreditsData::from([
                            'adminId' => Auth::id(),
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
                */
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
                                    ['user_id' => $user->id, 'email' => $user->email],
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
