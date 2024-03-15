<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Livewire\Component;
use Filament\Forms\Form;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Modules\Xot\Actions\GetViewAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class RatingsWithImage extends Component
{
    use InteractsWithForms;
    public Article $article;

    public string $tpl = 'v1';
    // public string $user_id;
    public array $datas;
    // public Profile $profile;
    public int $rating_id = 0;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(Article $article, string $tpl = 'v1'): void
    {
        $this->article = $article;
        $this->tpl = $tpl;

        $ratings = $this->article
            ->ratings()
            // ->with('media')
            ->where('user_id', null)
            ->get()
            // ->toArray()
        ;

        foreach($ratings as $key => $rating){
            $this->datas[$key] = $rating->toArray();
            $this->datas[$key]['image'] = $rating->getFirstMediaUrl('rating');
        }

        // dddx($this->datas);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function bet(int $rating_id, string $rating_title): void
    {
        $this->rating_id = $rating_id;

        $this->dispatch('bet-created',
            rating_id: $rating_id,
            rating_title: $rating_title
        );
    }
}
