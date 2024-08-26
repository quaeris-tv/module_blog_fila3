<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Actions\Profile;

use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Modules\Xot\Contracts\ProfileContract;

class AddCredits extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->translateLabel()
            ->action(
                function (ProfileContract $record, array $data): void {
                    dddx([$data, $record]);

                    // $user = $record->user;
                    // $profile_data = Arr::except($record->toArray(), ['id']);
                    // if (null == $user) {
                    //     $user_class = XotData::make()->getUserClass();
                    //     /** @var \Modules\Xot\Contracts\UserContract */
                    //    $user = $user_class::firstWhere(['email' => $record->email]);
                    // }

                    // if (null == $user) {
                    //     $user = $record->user()->create($profile_data);
                    // }
                    // $user->profile()->save($record);

                    // $user->update(
                    //     [
                    //         'password' => Hash::make($data['new_password']),
                    //     ]
                    // );
                    Notification::make()->success()->title('Add credit successfully.');
                }
            )
            ->form([
                TextInput::make('credits')
                    ->numeric()
                    ->required(),
            ])
            ->label('')
            ->icon('heroicon-o-currency-dollar')
            ->tooltip('Add Credits')
            ->modalDescription('Inserisci la quantità di crediti da aggiungere')
            ->modalHeading('Aggiungi Crediti')
            // ->requiresConfirmation()
            ->modalSubmitActionLabel('Aggiungi');
    }

    public static function getDefaultName(): ?string
    {
        return 'addCredits';
    }
}
