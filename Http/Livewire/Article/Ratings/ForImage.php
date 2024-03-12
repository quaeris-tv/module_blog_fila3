<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article\Ratings;

use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Livewire\Attributes\On;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetViewAction;

/**
 * @property ComponentContainer $form
 */
class ForImage extends Page implements HasForms
{
    use InteractsWithForms;
    public Article $article;

    public string $tpl = 'v1';

    public string $rating_title = '';
    public int $rating_id = 0;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(Article $article, string $tpl = 'v1'): void
    {
        $this->article = $article;
        $this->tpl = $tpl;
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
    public function myFunction(
        int $rating_id,
        string $rating_title)
    {
        $this->rating_id = $rating_id;
        $this->rating_title = $rating_title;
    }
}
