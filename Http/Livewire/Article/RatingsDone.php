<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetViewAction;

class RatingsDone extends Component // implements HasForms, HasActions
{// use InteractsWithActions;
            // use InteractsWithForms;

            public ?Article $article = null;
    public array $datas;

    public function mount(string $article_uuid): void
    {
        Assert::notNull($this->article = Article::where('uuid', $article_uuid)->first());
        $this->datas = $this->article->getArrayRatingsWithImage();
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
