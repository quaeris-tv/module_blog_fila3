<?php

declare(strict_types=1);
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Datas\RatingArticleWinnerData;
use Modules\Blog\Events\Article\CloseArticle;
use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Events\RatingArticleWinner;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ArticleAggregate extends AggregateRoot
{
    public function winner(RatingArticleWinnerData $command)
    {
        $event = new RatingArticleWinner(
            ratingId: $command->ratingId,
            articleId: $command->articleId
        );
        $this->recordThat($event);

        $this->recordThat(
            new CloseArticle(
                articleId: $event->articleId
            )
        );

        $this->persist();

        return $this;
    }

    public function rating(RatingArticleData $command): static
    {
        $event = new RatingArticle(
            userId: $command->userId,
            articleId: $command->articleId,
            ratingId: $command->ratingId,
            credit: $command->credit);
        $this->recordThat($event);
        $this->persist();

        return $this;
    }
}
