<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article\Ratings;

use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Livewire\Attributes\On;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Modules\Xot\Actions\GetViewAction;

/**
 * @property ComponentContainer $form
 */
class ForImage extends Page implements HasForms
{
    use InteractsWithForms;
    public Article $article;

    public string $tpl = 'v1';
    public string $user_id;
    // public array $data = [];
    public Profile $profile;
    public array $article_ratings = [];
    // public array $chosen_bet = [];
    public ?string $rating_title = '';
    public ?int $rating_id = null;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'filament.pages.edit-company';

    public function mount(Article $article, string $tpl = 'v1'): void
    {
        $this->article = $article;
        $this->tpl = $tpl;

        // $this->article_ratings = $this->article
        //     ->ratings()
        //     ->where('user_id', null)
        //     ->distinct()
        //     ->get()
        //     ->toArray();
        // dddx($article_ratings);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /**
         * @phpstan-var view-string
         */
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
        // int $rating_id,
        string $rating_title)
    {
        // $this->reset('rating_title');
        // $this->reset('rating_id');

        // $this->chosen_bet['rating_id'] = $rating_id;
        // $this->chosen_bet['rating_title'] = $rating_title;

        // $this->rating_id = $rating_id;
        $this->rating_title = $rating_title;

        // $this->render();

        // dddx('listen bet-created id '.$this->chosen_bet['rating_id'].' with title '.$this->chosen_bet['rating_title']);
        // $this->reset('chosen_bet');

        // dddx($this->chosen_bet);
    }
}
