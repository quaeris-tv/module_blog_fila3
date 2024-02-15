<?php

declare(strict_types=1);
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

use Modules\Blog\Datas\AddedCreditsData;
use Modules\Blog\Events\Rating\CreditsAdded;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ProfileAggregate extends AggregateRoot
{
    public function creditAdded(AddedCreditsData $addedCreditsData): self
    {
        //$event = new CreditsAdded($addedCreditsData);
        //dddx($event);
        //$this->recordThat($event);

        return $this;
    }
}
