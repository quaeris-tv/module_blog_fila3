<?php
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

use Modules\Blog\Datas\RatingData;
use Modules\Blog\Events\Rating\CreditAdded;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class RatingAggregate extends AggregateRoot
{

    public function addCredit(RatingData $ratingData)
    {
        $event=new CreditAdded($ratingData);

        $this->recordThat($event);

        return $this;
    }

}

