<?php

<<<<<<< HEAD
declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Modules\Blog\Events\ArticleRegistered;
use Modules\Blog\Events\ProductReplenished;
use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Models\Article;
use Modules\Rating\Models\RatingMorph;
=======
namespace Modules\Blog\Projectors;

use Modules\Blog\Models\Article;
use Modules\Blog\Events\ProductPurchased;
use Modules\Blog\Events\ArticleRegistered;
use Modules\Blog\Events\ProductRegistered;
use Modules\Blog\Events\ProductReplenished;
use Modules\Blog\Events\RatingArticle;
>>>>>>> e600cc0 (.)
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ArticleProjector extends Projector
{
    public function onProductRegistered(ArticleRegistered $event): void
    {
<<<<<<< HEAD
        $data = (array) $event;
=======
        $data = (array)$event;
>>>>>>> e600cc0 (.)

        Article::create($data);
    }

    public function onRatingArticle(RatingArticle $event): void
    {
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
        //    ->decrementAvailability($event->quantity);


        //$account = Account::uuid($event->aggregateRootUuid());
        //$account->balance += $event->amount;
        //$account->save();
        dddx($event->aggregateRootUuid());
    }

    //public function onProductReplenished(ProductReplenished $event)
    //{
        //Product::withProductId($event->productId)
        //    ->incrementAvailability($event->quantity);
    //}
>>>>>>> e600cc0 (.)
}
