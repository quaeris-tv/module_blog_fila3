<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Modules\Blog\Events\ArticleRegistered;
use Modules\Blog\Events\ProductReplenished;
use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Models\Article;
use Modules\Rating\Models\RatingMorph;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ArticleProjector extends Projector
{
    public function onProductRegistered(ArticleRegistered $event): void
    {
        $data = (array) $event;

        Article::create($data);
    }

    public function onRatingArticle(RatingArticle $event): void
    {
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

    public function onSetWinningOption(SetWinningOption $event): void
    {
        $rating_morph = RatingMorph::where([
            'rating_id' => $event->ratingId, 
            'model_type' => 'article',
            'model_id' => $event->articleId,
            'value' => null
        ]);
        dddx($rating_morph);
        $rating_morph->note = 'correct';
        $rating_morph->save();
    }

    // public function onProductReplenished(ProductReplenished $event)
    // {
    // Product::withProductId($event->productId)
    //    ->incrementAvailability($event->quantity);
    // }
}
