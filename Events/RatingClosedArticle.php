<?php

declare(strict_types=1);

/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Events/ProductPurchased.php
 */

namespace Modules\Blog\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class RatingClosedArticle extends ShouldBeStored
{
    public function __construct(
        readonly public string $userId,
        readonly public string $articleId,
        readonly public string $ratingId,
        readonly public int $credit,
    ) {
    }
}
