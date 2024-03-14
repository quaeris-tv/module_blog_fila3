<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article\Ratings;

use Filament\Facades\Filament;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Blog\Aggregates\ArticleAggregate;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetViewAction;

class ForImage extends Component implements HasForms
{
    use InteractsWithForms;
    public Article $article;

    public string $tpl = 'v1';

    public string $rating_title = '';
    public int $rating_id = 0;
    public array $article_ratings = [];
    public int $import = 0;

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
        $article_aggregate = ArticleAggregate::retrieve($this->article->id);
        if (0 != $this->import && 0 != $this->rating_id) {
            $command = RatingArticleData::from([
                'userId' => (string) Filament::auth()->id(),
                'articleId' => $this->article->id,
                'ratingId' => $this->rating_id,
                'credit' => $this->import,
            ]);

            $article_aggregate->rating($command);
        }

        $this->rating_id = 0;
        $this->rating_title = '';
        $this->import = 0;

        // $this->reset();
    }
}
