<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Modules\Xot\Actions\GetViewAction;

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

        if (null == $ratings) {
            $this->article = $article;
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

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->requiresConfirmation()
            ->action(fn () => dddx('a'));
    }
}
