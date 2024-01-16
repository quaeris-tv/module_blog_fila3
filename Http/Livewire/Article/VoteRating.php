<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Rating\Models\Rating;
use Modules\Xot\Actions\GetViewAction;

class VoteRating extends Component
{
    public string $tpl = 'v1';

    public Article $article;

    public function mount($article): void
    {
        $this->article = $article;
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        // dddx($view);
        $view_params = [
            'article' => $this->article,
        ];

        return view($view, $view_params);
    }

    public function vote(Rating $rating)
    {
        $this->article->ratings()->attach($rating->id, ['user_id' => \Auth::id()]);
        dddx($rating);
    }
}
