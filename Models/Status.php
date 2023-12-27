<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Spatie\ModelStatus\Status as BaseStatus;

class Status extends BaseStatus
{
    /**
     * @var string
     */
    protected $connection = 'blog';
}
