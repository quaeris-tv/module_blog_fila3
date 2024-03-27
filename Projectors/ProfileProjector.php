<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Modules\Blog\Events\Rating\CreditsAdded;
use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Models\Profile;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ProfileProjector extends Projector
{
    public function onRatingArticle(RatingArticle $event): void
    {
        // forse meglio all'inizio di tutto, come primo controllo?
        $profile = Profile::firstOrCreate(['user_id' => $event->userId], ['credits' => 1000]);

        // if ($profile->credits - $event->credit < 0) {
        //     throw new \Exception('there are not enough credits Your credits ['.$profile->credits.']');
        // }
        $profile->decrement('credits', $event->credit);
    }

    public function onCreditsAdded(CreditsAdded $event): void
    {
        dddx('wip');
    }
}
