<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Spatie\Tags\Tag as BaseTag;

class Tag extends BaseTag
{
    /**
     * @var string
     */
    protected $connection = 'blog';
}
