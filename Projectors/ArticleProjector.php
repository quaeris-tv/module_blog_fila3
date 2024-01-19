<?php

<<<<<<< HEAD
<<<<<<< HEAD
declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Modules\Blog\Events\ArticleRegistered;
use Modules\Blog\Events\ProductReplenished;
use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Models\Article;
use Modules\Rating\Models\RatingMorph;
=======
=======
declare(strict_types=1);

>>>>>>> 934879b (Lint)
namespace Modules\Blog\Projectors;

use Modules\Blog\Events\ArticleRegistered;
use Modules\Blog\Events\ProductReplenished;
use Modules\Blog\Events\RatingArticle;
<<<<<<< HEAD
>>>>>>> e600cc0 (.)
=======
use Modules\Blog\Models\Article;
>>>>>>> 934879b (Lint)
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ArticleProjector extends Projector
{
    public function onProductRegistered(ArticleRegistered $event): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $data = (array) $event;
=======
        $data = (array)$event;
>>>>>>> e600cc0 (.)
=======
        $data = (array) $event;
>>>>>>> 934879b (Lint)

        Article::create($data);
    }

    public function onRatingArticle(RatingArticle $event): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
        // Product::withProductId($event->productId)
        //    ->decrementAvailability($event->quantity);

        // $account = Account::uuid($event->aggregateRootUuid());
        // $account->balance += $event->amount;
        // $account->save();
        RatingMorph::firstOrCreate(
            [
                'rating_id' => $event->ratingId,
                'model_type' => 'article',
                'model_id' => $event->articleId,
                'user_id' => $event->userId,
            ],
            [
                'value' => 0,
            ]
        )->increment('value', $event->credit);
    }

    // public function onWinning(RatingData $event): void
    // {
    //     dddx(['article projector', $event]);
    // }

    // public function onProductReplenished(ProductReplenished $event)
    // {
    // Product::withProductId($event->productId)
    //    ->incrementAvailability($event->quantity);
    // }
=======
        //Product::withProductId($event->productId)
=======
        // Product::withProductId($event->productId)
>>>>>>> 934879b (Lint)
        //    ->decrementAvailability($event->quantity);

        // $account = Account::uuid($event->aggregateRootUuid());
        // $account->balance += $event->amount;
        // $account->save();
        dddx($event->aggregateRootUuid());
    }

<<<<<<< HEAD
    //public function onProductReplenished(ProductReplenished $event)
    //{
        //Product::withProductId($event->productId)
        //    ->incrementAvailability($event->quantity);
    //}
>>>>>>> e600cc0 (.)
=======
    // public function onProductReplenished(ProductReplenished $event)
    // {
    // Product::withProductId($event->productId)
    //    ->incrementAvailability($event->quantity);
    // }
>>>>>>> 934879b (Lint)
}
