<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Blog\Datas\ArticleData;
use Modules\Blog\Datas\RatingInfoData;
use Modules\Rating\Models\RatingMorph;
use Modules\Xot\Actions\GetViewAction;

class RatingsDone extends Component // implements HasForms, HasActions
{// use InteractsWithActions;
    // use InteractsWithForms;

    // public ?array $article = null;
    public array $user_ratings;

    public function mount(ArticleData $article_data): void
    {
        // $this->article = $article_data->toArray();

        $user_ratings = RatingMorph::where('user_id', Auth::user()->id)
                ->where('model_id', $article_data->id)
                ->get()->toArray();

        $ratings_options = collect($article_data->ratings);
        // dddx($ratings_options->where('id', 170)->first());
        foreach ($user_ratings as $rating) {
            // dddx($rating);
            // dddx([
            //     $rating,
            //     $this->article
            // ]);
            $tmp = $ratings_options->where('id', $rating['id'])->first();
            dddx($tmp);
            $this->user_ratings[] = RatingInfoData::from([
                'ratingId' => $rating['rating_id'],
                'title' => $tmp['title'],
                'credit' => $rating['value'],
                'image' => $tmp['image'],
            ]);
        }

        dddx($this->user_ratings);

        // dddx([
        //     $this->article,
        //     $this->user_ratings,
        //     // collect($this->article->ratings)->where('id', 170)->first()['image']
        // ]);
    }

    public function render(): View
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
}
