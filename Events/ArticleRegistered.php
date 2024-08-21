<?php

declare(strict_types=1);

namespace Modules\Blog\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ArticleRegistered extends ShouldBeStored
{
    public function __construct(
        readonly public string $uuid,
        readonly public string $title,
    ) {}
}
