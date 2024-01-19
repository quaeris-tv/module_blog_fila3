<?php
<<<<<<< HEAD
<<<<<<< HEAD

declare(strict_types=1);
=======
>>>>>>> e600cc0 (.)
=======

declare(strict_types=1);
>>>>>>> 934879b (Lint)
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Datas\RatingData;
use Modules\Blog\Events\Article\Winning;
=======
use Modules\Blog\Datas\RatingData;
=======
>>>>>>> 934879b (Lint)
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Events\Rating\CreditAdded;
>>>>>>> e600cc0 (.)
use Modules\Blog\Events\RatingArticle;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ArticleAggregate extends AggregateRoot
{
<<<<<<< HEAD
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

=======
>>>>>>> 934879b (Lint)
    public function rating(RatingArticleData $command): static
    {
        $event = new RatingArticle(
            userId: $command->userId,
            articleId: $command->articleId,
            ratingId: $command->ratingId,
            credit: $command->credit);
<<<<<<< HEAD
=======

    public function rating(RatingArticleData $command):static {

        $event=new RatingArticle(
            userId:$command->userId,
            articleId:$command->articleId,
            ratingId:$command->ratingId,
            credit:$command->credit);
>>>>>>> e600cc0 (.)
=======
>>>>>>> 934879b (Lint)
        $this->recordThat($event);
        $this->persist();

        return $this;
    }
<<<<<<< HEAD
<<<<<<< HEAD
}
=======

}

>>>>>>> e600cc0 (.)
=======
}
>>>>>>> 934879b (Lint)
