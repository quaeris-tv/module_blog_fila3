<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Modules\Blog\Models\Order;
use Modules\Blog\Events\RatingArticle;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class OrderProjector extends Projector
{
    public function onRatingArticle(RatingArticle $event): void
    {
        $date = date('Y-m-d');

        Order::firstOrCreate(
            [
                'rating_id' => $event->ratingId,
                'article_id' => $event->articleId,
                'date' => $date,
            ],
            [
                'bet_credits' => 0,
            ]
        )->increment('bet_credits', $event->credit);
    }
}
