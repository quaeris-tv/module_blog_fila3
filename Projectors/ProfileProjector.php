<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Models\Order;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ProfileProjector extends Projector
{
    public function onRatingArticle(RatingArticle $event): void
    {
        dddx('profile projector');
    }
}
