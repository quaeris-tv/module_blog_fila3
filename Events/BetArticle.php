<?php

declare(strict_types=1);

namespace Modules\Blog\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class BetArticle extends ShouldBeStored
{
    public array $betAttributes;

    /**
     * @var string
     */
    protected $connection = 'activity';

    public function __construct(array $betAttributes)
    {
        $this->betAttributes = $betAttributes;
    }
}
