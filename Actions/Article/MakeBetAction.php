<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Filament\Facades\Filament;
use Modules\Blog\Aggregates\ArticleAggregate;
use Modules\Blog\Datas\RatingArticleData;

class MakeBetAction
{
    public function execute(string $article_id, int $import, int $rating_id): void
    {
        $article_aggregate = ArticleAggregate::retrieve($article_id);
        if (0 != $import && 0 != $rating_id) {
            $command = RatingArticleData::from([
                'userId' => (string) Filament::auth()->id(),
                'articleId' => $article_id,
                'ratingId' => $rating_id,
                'credit' => $import,
            ]);

            $article_aggregate->rating($command);
        }
    }
}
