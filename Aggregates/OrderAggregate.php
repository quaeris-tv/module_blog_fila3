<?php

declare(strict_types=1);
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

use Modules\Blog\Datas\RatingData;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Events\Rating\CreditAdded;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class OrderAggregate extends AggregateRoot
{
    public function addStats(RatingArticleData $ratingData)
    {
        $mytime = date('Y-m-d'); ;
        dddx(gettype($mytime));


        // $event = new addStats($ratingData);

        // $this->recordThat($event);

        // return $this;
    }
}
