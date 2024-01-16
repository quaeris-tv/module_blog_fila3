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
        $ratings_options = $this->article->ratings()->where('user_id', null)->get();

        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        // dddx($view);
        $view_params = [
            'ratings_options' => $ratings_options,
        ];

        return view($view, $view_params);
    }

    public function vote(Rating $rating)
    {
        // $rating_voted =  $this->article->ratings()
        //         // ->where('rating_id', $rating->id)
        //         // ->where('user_id', \Auth::id())
        //         // ->first();
        //         ->get();

        // if($rating_voted){
        //     $this->article->ratings()
        //         ->where('user_id', \Auth::id())
        //         ->delete($rating_voted->id);
        // }

        $this->article->ratings()->attach($rating->id, ['user_id' => \Auth::id()]);
        dddx($rating);
    }
}
