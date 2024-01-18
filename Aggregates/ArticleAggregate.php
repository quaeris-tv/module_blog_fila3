<?php
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

use Modules\Blog\Datas\RatingData;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Events\Rating\CreditAdded;
use Modules\Blog\Events\RatingArticle;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ArticleAggregate extends AggregateRoot
{

    public function rating(RatingArticleData $command):static {

        $event=new RatingArticle(
            userId:$command->userId,
            articleId:$command->articleId,
            ratingId:$command->ratingId,
            credit:$command->credit);
        $this->recordThat($event);
        $this->persist();

        return $this;
    }

}

