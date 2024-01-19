<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Contracts\Support\Renderable;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> 35a88cb (Lint)
=======
>>>>>>> 0f9a9ba (test)
=======
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
>>>>>>> bba6ab7 (Lint)
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Modules\Rating\Models\Rating;
use Modules\Xot\Actions\GetViewAction;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Webmozart\Assert\Assert;
=======
>>>>>>> 35a88cb (Lint)
=======
use Illuminate\Contracts\Support\Renderable;
>>>>>>> 0f9a9ba (test)
=======
use Webmozart\Assert\Assert;
>>>>>>> bba6ab7 (Lint)

class VoteRating extends Component
{
    public string $tpl = 'v1';

    public Article $article;

    public Profile $profile;

<<<<<<< HEAD
    public Profile $profile;

=======
>>>>>>> 0f9a9ba (test)
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
<<<<<<< HEAD
<<<<<<< HEAD
=======

>>>>>>> 6223082 (wip VoteRating.php)
=======
>>>>>>> 9a40889 (Lint)
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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 6223082 (wip VoteRating.php)
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

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        // Account::createWithAttributes(['name' => 'Yoda']);
        $this->profile->betArticle(['rating__id' => $rating->id, 'amount' => 10]);

        $this->article->ratings()->attach($rating->id, ['user_id' => Auth::id()]);
=======
=======

>>>>>>> 6223082 (wip VoteRating.php)
=======
>>>>>>> 9a40889 (Lint)
        $this->article->ratings()->attach($rating->id, ['user_id' => \Auth::id()]);
>>>>>>> 35a88cb (Lint)
=======
        // Account::createWithAttributes(['name' => 'Yoda']);
        $this->profile->betArticle(['rating__id' => $rating->id, 'amount' => 10]);

        $this->article->ratings()->attach($rating->id, ['user_id' => Auth::id()]);
>>>>>>> 0f9a9ba (test)
        dddx($rating);
    }
}
