<?php

<<<<<<< HEAD
<<<<<<< HEAD
declare(strict_types=1);

=======
>>>>>>> e600cc0 (.)
=======
declare(strict_types=1);

>>>>>>> 934879b (Lint)
namespace Modules\Blog\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ArticleRegistered extends ShouldBeStored
{
    public function __construct(
        readonly public string $uuid,
        readonly public string $title,
<<<<<<< HEAD
<<<<<<< HEAD
    ) {
    }
=======
    ) {}
>>>>>>> e600cc0 (.)
=======
    ) {
    }
>>>>>>> 934879b (Lint)
}
