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
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Events/ProductPurchased.php
 */

namespace Modules\Blog\Events\Rating;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CreditAdded extends ShouldBeStored
{
    public function __construct(
<<<<<<< HEAD
        // readonly public string $productId,
        // readonly public string $orderId,
        // readonly public int $quantity,

        readonly public string $ratingId,
        readonly public string $userId,
        readonly public int $credit,
    ) {
    }
=======
        readonly public string $productId,
        readonly public string $orderId,
<<<<<<< HEAD
        readonly public int    $quantity,
    ) {}
>>>>>>> e600cc0 (.)
=======
        readonly public int $quantity,
    ) {
    }
>>>>>>> 934879b (Lint)
}
