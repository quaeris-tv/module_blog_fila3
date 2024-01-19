<?php

declare(strict_types=1);
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Events/ProductPurchased.php
 */

namespace Modules\Blog\Events\Article;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class SetWinningOption extends ShouldBeStored
{
    public function __construct(
        readonly public string $ratingId,
        readonly public string $articleId,
    ) {
    }
}
