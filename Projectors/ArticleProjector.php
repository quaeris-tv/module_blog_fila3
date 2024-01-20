<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Modules\Blog\Events\Article\CloseArticle;
use Modules\Blog\Events\ArticleRegistered;
use Modules\Blog\Events\ProductReplenished;
use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Events\RatingArticleWinner;
use Modules\Blog\Models\Article;
use Modules\Rating\Models\RatingMorph;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ArticleProjector extends Projector
{
    // public function onProductRegistered(ArticleRegistered $event): void
    // {
    //     $data = (array) $event;

    //     Article::create($data);
    // }

    public function onRatingArticle(RatingArticle $event): void
    {
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

    public function onRatingArticleWinner(RatingArticleWinner $event): void
    {
        $rating_morph = RatingMorph::firstWhere([
            'rating_id' => $event->ratingId,
            'model_type' => 'article',
            'model_id' => $event->articleId,
            'user_id' => null,
        ]);

        // if(null == $rating_morph){
        //     dddx('null');
        // }

        $rating_morph->is_winner = true;
        $rating_morph->save();
    }

    public function onCloseArticle(CloseArticle $event): void
    {
        $article = Article::find($event->articleId);
        $article->is_closed = true;
        $article->save();
    }

    // public function onProductReplenished(ProductReplenished $event)
    // {
    // Product::withProductId($event->productId)
    //    ->incrementAvailability($event->quantity);
    // }
}
