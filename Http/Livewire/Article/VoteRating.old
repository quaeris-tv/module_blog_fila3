<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Modules\Rating\Models\Rating;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

class VoteRating extends Component
{
    public string $tpl = 'v1';

    public Article $article;

    public Profile $profile;

    public function mount(Article $article): void
    {
        $this->article = $article;
        Assert::notNull($user = Auth::user());
        $this->profile = Profile::firstOrCreate(
            ['user_id' => $user->id],
            ['email' => $user->email]
        );
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

        // Account::createWithAttributes(['name' => 'Yoda']);
        // $this->profile->betArticle(['rating__id' => $rating->id, 'amount' => 10]);

        $this->article->ratings()->attach($rating->id, ['user_id' => Auth::id()]);
        dddx($rating);
    }
}
