<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Headernav;

use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetViewAction;
use Illuminate\Contracts\Support\Renderable;

class SearchBar extends Component
{
    public string $tpl = 'v1';
    public string $search = '';

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $results = [];


        if (!empty($this->search)) {
            $results = Article::where('title', 'like', '%' . $this->search . '%')->get();
        }


        $view_params = [
            'results' => $results
        ];

        return view($view, $view_params);
    }
}
