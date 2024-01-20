<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Modules\Blog\Events\RatingArticle;
use Modules\Rating\Models\RatingMorph;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class RatingProjector extends Projector
{
    public function onCreditAdded(RatingArticle $event): void
    {
        dddx($event);

        $rating_morphs = RatingMorph::where('rating_id', $ratingData->ratingId)
        ->where('model_type', 'article')
        ->where('user_id', '<>', null)
        ->get();
        // dddx($rating_morphs);

        foreach ($rating_morphs as $rm) {
            dddx($rm);

            // RatingAggregate::retrieve($command->articleId)
            //     ->addCredit($command);
        }
    }
}
