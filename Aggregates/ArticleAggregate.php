<?php
<<<<<<< HEAD

declare(strict_types=1);
=======
>>>>>>> e600cc0 (.)
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

<<<<<<< HEAD
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Datas\RatingData;
use Modules\Blog\Events\Article\Winning;
=======
use Modules\Blog\Datas\RatingData;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Events\Rating\CreditAdded;
>>>>>>> e600cc0 (.)
use Modules\Blog\Events\RatingArticle;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ArticleAggregate extends AggregateRoot
{
<<<<<<< HEAD
    // public function winning(RatingData $ratingData)
    // {
    //     // dddx($ratingData->ratingId);

    //     $event = new Winning(
    //         ratingId: $ratingData->ratingId);
    //     $this->recordThat($event);
    //     $this->persist();

    //     return $this;
    // }

    public function rating(RatingArticleData $command): static
    {
        $event = new RatingArticle(
            userId: $command->userId,
            articleId: $command->articleId,
            ratingId: $command->ratingId,
            credit: $command->credit);
=======

    public function rating(RatingArticleData $command):static {

        $event=new RatingArticle(
            userId:$command->userId,
            articleId:$command->articleId,
            ratingId:$command->ratingId,
            credit:$command->credit);
>>>>>>> e600cc0 (.)
        $this->recordThat($event);
        $this->persist();

        return $this;
    }
<<<<<<< HEAD
}
=======

}

>>>>>>> e600cc0 (.)
