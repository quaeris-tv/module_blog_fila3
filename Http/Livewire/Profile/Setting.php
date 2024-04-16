<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Profile;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Webmozart\Assert\Assert;
use Modules\Blog\Models\Profile;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Toggle;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Modules\Xot\Actions\GetViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Blog\Actions\Article\MakeBetAction;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class Setting extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public string $tpl = 'setting';
    public string $version = 'v1';
    public Profile $model;
    public array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(Profile $model, string $tpl = 'v1'): void {
        $this->model = $model;

        $this->tpl = $tpl;
        // dddx($this->model->toArray());

        $this->data['name'] = $this->model->user_name;

        $this->form->fill($this->data);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->version);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function editProfile()
    {
        $this->mountAction('edit');
    }

    public function editAction(): Action
    {
        return Action::make('edit')
            ->action(function (array $arguments, array $data) {
                $this->save($data);
            })
            ->fillForm(fn ($record, $arguments): array => [
                'user_name' => $this->model->user_name,
                'first_name' => $this->model->first_name,
                'last_name' => $this->model->last_name,
            ])
            ->form([
                FileUpload::make('extra.photo_profile')
                    ->hiddenLabel()
                    ->alignCenter()
                    ->avatar()
                    ->hidden(fn ($state) => $this->model->extra->photo_profile)
                    ->disk('uploads')
                    ->directory('photos'),
                TextInput::make('user_name')
                    ->label('User Name'),
                TextInput::make('first_name')
                    ->label('First Name'),
                TextInput::make('last_name')
                    ->label('Last Name'),
                // SpatieMediaLibraryFileUpload::make('media')
                //     ->image()
                //     // ->maxSize(5000)
                //     // ->multiple()
                //     // ->enableReordering()
                //     ->openable()
                //     ->downloadable()
                //     ->columnSpanFull()
                //     // ->conversion('thumbnail')
                //     ->disk('uploads')
                //     ->directory('photos')
                //     ->collection('photo_profile'),


                
                //     // ->panelLayout('grid')
                //     // ->validationAttribute(__('Files'))
                //     // ->multiple()
                //     // ->acceptedFileTypes(['application/json'])



            ])
            ->modalHeading('Edit Profile')
            ->closeModalByClickingAway(false)
            ->modalCloseButton(false)
            ->modalWidth(MaxWidth::Small)
            ->modalSubmitActionLabel('Please select an outcome')
            ->modalCancelActionLabel('Cancel')
            ->color('primary')
            // ->modalIcon('heroicon-o-banknotes')
            ->stickyModalHeader()
            ->stickyModalFooter()
        ;
    }

    public function save(array $data): void
    {
        $this->model->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'extra' => $data['extra']
        ]);

        // dddx($data);
        Assert::notNull($this->model->user);
        $this->model->user->update(['name' => $data['user_name']]);

        // dddx('done');
    }

    public function saveExtra(): void
    {
        $data = $this->form->getState();
        /* Property Modules\Blog\Models\Profile::$extra
        (Illuminate\Database\Eloquent\Collection<string, bool>)
        does not accept
        array<string, mixed>.
        */
        $this->model->extra->set($data);
        $this->model->save();
    }
}
