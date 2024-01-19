<?php
<<<<<<< HEAD
<<<<<<< HEAD

declare(strict_types=1);
=======
>>>>>>> e600cc0 (.)
=======

declare(strict_types=1);
>>>>>>> 934879b (Lint)
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

use Modules\Blog\Datas\RatingData;
use Modules\Blog\Events\Rating\CreditAdded;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class RatingAggregate extends AggregateRoot
{
<<<<<<< HEAD
<<<<<<< HEAD
    public function addCredit(RatingData $ratingData)
    {
        $event = new CreditAdded($ratingData);
=======

    public function addCredit(RatingData $ratingData)
    {
        $event=new CreditAdded($ratingData);
>>>>>>> e600cc0 (.)
=======
    public function addCredit(RatingData $ratingData)
    {
        $event = new CreditAdded($ratingData);
>>>>>>> 934879b (Lint)

        $this->recordThat($event);

        return $this;
    }
<<<<<<< HEAD
<<<<<<< HEAD
}
=======

}

>>>>>>> e600cc0 (.)
=======
}
>>>>>>> 934879b (Lint)
