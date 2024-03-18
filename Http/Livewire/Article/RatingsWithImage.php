<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Livewire\Component;
use Filament\Actions\Action;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Modules\Xot\Actions\GetViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class RatingsWithImage extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public ?Article $article = null;

    // public string $tpl = 'v1';
    // public string $user_id;
    public array $datas;
    // public Profile $profile;
    public int $rating_id = 0;
    public string $type = 'show';

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(Article $article, string $type, ?array $ratings = null): void
    {
        // $this->tpl = $tpl;
        $this->type = $type;
        $this->article = $article;
        if (null == $ratings) {

            $this->datas = $this->article->getArrayRatingsWithImage();
        } else {
            $this->datas = $ratings;
        }
        // dddx($this->datas);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute();

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function bet(int $rating_id, string $rating_title): void
    {
        $this->rating_id = $rating_id;

        if ('show' == $this->type) {
            $this->dispatch('bet-created',
                rating_id: $rating_id,
                rating_title: $rating_title
            );

            foreach ($this->datas as $key => $data) {
                if ($this->datas[$key]['id'] == $rating_id) {
                    $this->datas[$key]['effect'] = true;
                } else {
                    $this->datas[$key]['effect'] = false;
                }
            }
        } else {
            dddx('wip');
        }
    }

    public function betAction(): Action
    {
        return Action::make('bet')
            ->form([
                Select::make('option')
                    ->label('Selezione un opzione')
                    // ->options([
                    //     'draft' => 'Draft',
                    //     'reviewing' => 'Reviewing',
                    //     'published' => 'Published',
                    // ]),
                    ->options(function (){
                        $options = [];
                        foreach($this->datas as $key => $data){
                            $options[$key] = $data['title'];
                        }
                        return $options;
                    }),
                TextInput::make('credit')
                    ->label('')
                    ->tel()
            ])
            ->requiresConfirmation()
            ->modalHeading('Effettua scommessa')
            ->modalDescription('Punta la tua cifra')
            ->modalSubmitActionLabel('confermo')
            ->modalIcon('heroicon-o-banknotes')
            // ->action(fn () => dddx('a'))
            ->action(function (array $data): void {
                // dddx($data);
                dddx([
                    $this->datas
                ]);
            })
            ;
    }
}
