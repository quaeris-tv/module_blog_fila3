<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Carbon\Carbon;
use Modules\Blog\Models\Order;
use Modules\Blog\Models\Article;
use Modules\Blog\Events\RatingArticle;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class OrderProjector extends Projector
{
    public function onRatingArticle(RatingArticle $event): void
    {
        Order::firstOrCreate(
            [
                'rating_id' => $event->ratingId,
                'model_type' => Article::class,
                'model_id' => $event->articleId,
                'date' => Carbon::today(),
            ],
            [
                'bet_credits' => 0,
            ]
        )->increment('bet_credits', $event->credit);
    }
}
