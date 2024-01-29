<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

class Page extends BaseModel
{
    protected $fillable = [
        'content',
        'slug',
        'title',
        'content_blocks',
        'footer_blocks',
    ];
}
