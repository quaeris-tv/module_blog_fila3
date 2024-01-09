<?php

declare(strict_types=1);

namespace Modules\Blog\View\Components\Article;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
<<<<<<< HEAD
use Modules\Blog\Models\Article;
=======
>>>>>>> dev
use Modules\Blog\Models\Post;
use Modules\Xot\Actions\GetViewAction;

// use Modules\Xot\View\Components\XotBaseComponent;

/**
 * .
 */
class Card extends Component
{
    public function __construct(
<<<<<<< HEAD
        public Article|Post $article,
=======
        public Post $article,
>>>>>>> dev
        public bool $showAuthor = false,
        public string $tpl = 'v1')
    {
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [];

        return view($view, $view_params);
    }
}
