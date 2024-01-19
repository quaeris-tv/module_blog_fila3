<?php

<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> e600cc0 (.)
namespace Modules\Blog\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ArticleRegistered extends ShouldBeStored
{
    public function __construct(
        readonly public string $uuid,
        readonly public string $title,
<<<<<<< HEAD
    ) {
    }
=======
    ) {}
>>>>>>> e600cc0 (.)
}
