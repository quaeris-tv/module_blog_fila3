<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Blog\Datas\RatingInfoData;
use Modules\Blog\Models\Article;
use Modules\Rating\Models\RatingMorph;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

// implements HasForms, HasActions

class RatingsDone extends Component
{
    // use InteractsWithActions;
    // use InteractsWithForms;

    public array $user_ratings;
    public array $article_data;
    public array $user;

    public function mount(array $article_data): void
    {
        $this->article_data = $article_data;

        Assert::notNull($user = Auth::user());
        $this->user = $user->toArray();

        $this->user_ratings = $this->getUserRatings();

        // $user_ratings = RatingMorph::where('user_id', $user->id)
        //         ->where('model_id', $this->article_data['id'])
        //         ->get()->toArray();

        // $ratings_options = collect($this->article_data['ratings']);

        // foreach ($user_ratings as $key => $rating) {
        //     Assert::isArray($rating);
        //     $tmp = $ratings_options->where('id', $rating['rating_id'])->first();
        //     $this->user_ratings[] = RatingInfoData::from([
        //         'ratingId' => $rating['rating_id'],
        //         'title' => $tmp['title'],
        //         'credit' => $rating['value'],
        //         'image' => $tmp['image'],
        //     ])->toArray();
        // }

        // dddx($this->user_ratings);
    }

    public function getUserRatings(): array
    {
        $result = [];

        $user_ratings = RatingMorph::where('user_id', $this->user['id'])
                ->where('model_id', $this->article_data['id'])
                ->get()->toArray();

        Assert::isArray($this->article_data['ratings']);
        $ratings_options = collect($this->article_data['ratings']);

        $percs = $this->getPercs();

        foreach ($user_ratings as $key => $rating) {
            Assert::isArray($rating);
            $tmp = $ratings_options->where('id', $rating['rating_id'])->first();
            if($tmp != null){
                $result[] = RatingInfoData::from([
                    'ratingId' => $rating['rating_id'],
                    'title' => $tmp['title'],
                    'credit' => $rating['value'],
                    'image' => $tmp['image'],
                    'predict_victory' => $rating['value'] * $percs[$rating['rating_id']],
                ])->toArray();
            }else{
                $result[] = RatingInfoData::from([
                    'ratingId' => $rating['rating_id'],
                    'title' => 'not defined',
                    'credit' => $rating['value'],
                    'image' => '#',
                    'predict_victory' => 0,
                ])->toArray();
            }
        }
        $key_values = array_column($result, 'credit');
        array_multisort($key_values, SORT_DESC, $result);

        return $result;
    }

    public function getPercs(): array
    {
        $result = [];
        Assert::notNull($article = Article::find($this->article_data['id']));
        Assert::isInstanceOf($article, Article::class);
        $total_volume = $article->getVolumeCredit();

        foreach ($this->article_data['ratings'] as $rating) {
            $result[$rating['id']] = 0;
            if (0 != $total_volume) {
                $perc = $article->getVolumeCredit($rating['id']) / $total_volume;
                if (0 != $perc) {
                    $result[$rating['id']] = round(1 / $perc, 2);
                }
            }
        }

        return $result;
        // dddx($result);

        // dddx([
        //     $this->article_data,
        //     $article->getVolumeCredit(),
        //     $article->getVolumeCredit(171),
        //     $article->getVolumeCredit(170),
        // ]);
    }

    #[On('update-user-ratings')]
    public function updateUserRatings(): void
    {
        $this->user_ratings = $this->getUserRatings();
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
