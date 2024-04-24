<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article\Ratings;

use Livewire\Component;
use Livewire\Attributes\On;
use Filament\Facades\Filament;
use Modules\Blog\Models\Article;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Contracts\HasForms;
use Modules\Xot\Actions\GetViewAction;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Aggregates\ArticleAggregate;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Blog\Actions\Article\MakeBetAction;

class ForImage extends Component implements HasForms
{
    use InteractsWithForms;
    public Article $article;

    public string $tpl = 'v1';

    public string $rating_title = '';
    public int $rating_id = 0;
    public array $article_ratings = [];
    // #[Validate('required|gt:0')]
    // #[Validate('required|gt:0|lte:10'.Auth::user()->profile->credits).'']
    public int $import = 0;
    public string $type = 'show';

    // public array $form_data = ['credit' => 6];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(Article $article, string $tpl = 'v1'): void
    {
        $this->article = $article;
        $this->tpl = $tpl;
        $this->article_ratings = $article->getOptionRatingsIdTitle();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /** @phpstan-var view-string */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'view' => $view,
            'ratingTitle' => $this->rating_title,
            // 'chosen_bet_title' => $this->chosen_bet['rating_title'] ?? 'aaaaaaaa'
        ];

        return view($view, $view_params);
    }

    #[On('bet-created')]
    public function updateRating(
        int $rating_id,
        string $rating_title): void
    {
        $this->rating_id = $rating_id;
        $this->rating_title = $rating_title;
    }

    public function save(): void
    {
        // $this->validate([
        //     'import' => 'required|gt:0',
        //     // 'email' => 'required|email|unique:users,email',
        // ]);


        // $this->validate();

        $this->validate([ 
            'import' => 'required|gt:0|lte:'.Auth::user()->profile->credits,
            'rating_title' => 'required'
        ],[
            'import.required' => __('blog::article.rating.no_import'),
            'import.gt' => __('blog::article.rating.import_zero'),
            'import.lte' => __('blog::article.rating.import_min'),
            'rating_title.required' => __('blog::article.rating.no_choice')
        ]);

        app(MakeBetAction::class)->execute($this->article->id, $this->import, $this->rating_id);

        // $article_aggregate = ArticleAggregate::retrieve($this->article->id);
        // if (0 != $this->import && 0 != $this->rating_id) {
        //     $command = RatingArticleData::from([
        //         'userId' => (string) Filament::auth()->id(),
        //         'articleId' => $this->article->id,
        //         'ratingId' => $this->rating_id,
        //         'credit' => $this->import,
        //     ]);

        //     $article_aggregate->rating($command);
        // }

        $this->rating_id = 0;
        $this->rating_title = '';
        $this->import = 0;

        // $this->form_data['credit'] = 0;
        // dddx($this->form_data);
        // dddx([
        //     $this->rating_id,
        //     $this->rating_title,
        //     $this->import
        // ]);
    }
}
