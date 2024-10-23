<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Modules\Blog\Models\Article;

class RewardArticleAction
{
    public function execute(Article $article): void
    {
        if (now() < $article->closed_at) {
            return;
        }
        if (null !== $article->rewarded_at) {
            return;
        }

        dddx('a');
    }
}
