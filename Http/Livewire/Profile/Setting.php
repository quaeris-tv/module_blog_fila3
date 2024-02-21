<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Profile;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Arr;
use Filament\Actions\Action;
use Modules\Blog\Models\Profile;
use Filament\Forms\Components\Toggle;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Modules\Xot\Actions\GetViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

/**
 * @property ComponentContainer $form
 */
class Setting extends Page implements HasForms
{
    use InteractsWithForms;

    public string $tpl = 'setting';
    public string $version = 'v1';
    public Profile $model;
    public array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(
        Profile $model,
        string $tpl = 'v1'

        ): void
    {
        $this->model = $model;
        $this->tpl = $tpl;
        // dddx($this->model->toArray());

        $this->data['name'] = $this->model->user_name;


        // $this->data = $this->model->toArray();
        // unset(
        //     $this->data['id'],
        //     $this->data['user_id'],
        //     $this->data['created_at'],
        //     $this->data['updated_at'],
        //     $this->data['updated_by'],
        //     $this->data['created_by'],
        //     $this->data['deleted_at'],
        //     $this->data['deleted_by'],

        //     $this->data['credits'],

        //     $this->data['slug']
        // );

        // $this->data['photo_profile'] = $this->model->getFirstMedia('photo_profile');

        // dddx($this->data);

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

    public function url(string $name, array $params): string
    {
        return '#';
    }

    public function form(Form $form): Form
    {

        // dddx($this->model->extra->get('non_existing', 'default'));
        // $this->data['extra'] = $this->model->extra->get('newsletter', ['newsletter' => false]);
        // $this->data['extra'] = $this->model->extra->get('predix_updates', ['predix_updates' => false]);
        // $this->data['extra'] = $this->model->extra->get('market_updates', ['market_updates' => false]);

        // $this->data['extra'] = [
        //     $this->model->extra->get('newsletter', ['newsletter' => false]),
        //     $this->model->extra->get('predix_updates', ['predix_updates' => false]),
        //     $this->model->extra->get('market_updates', ['market_updates' => false])
        // ];

        // $this->model->extra->get('newsletter', ['newsletter' => false]);
        // $this->model->extra->get('predix_updates', ['predix_updates' => false]);
        // $this->model->extra->get('market_updates', ['market_updates' => false]);

        $this->model->extra->get('newsletter', false);
        $this->model->extra->get('predix_updates', false);
        $this->model->extra->get('market_updates', false);

        // dddx($this->model->extra->all());
        // dddx($this->data['extra']);


        $schema = [];
        foreach ($this->model->extra->all() as $key => $field) {

            // dddx([$key, $field]);
            // if(gettype($field) == 'float'){
            //     dddx([$key, $field]);
            // }
            // foreach($field as $key => $f){
                // dddx([$key, $f]);
                $schema[] = Toggle::make($key)
                    ->label($key)
                    // ->onColor('warning')
                    // ->offColor('warning')

                    // ->suffix(fn () => Arr::get($this->data, 'ratings.'.$rating->id.'.value', 0))
                    // ->extraInputAttributes(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-700 focus:ring-green-700 sm:text-sm'])
                    // ->extraInputAttributes(['class' => 'toggle'])
                    
                    // ->disabled()
                ;
            // }
        }

        // dddx($schema);
        return $form
            ->schema($schema)
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        // dddx($data);
        $this->model->user->update($data);
    }

    public function saveExtra(): void
    {
        $data = $this->form->getState();
        // dddx($data);
        $this->model->extra = $data;
        $this->model->save();
    }
}
