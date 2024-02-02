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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'images' => 'array',
        'id' => 'string',
        'uuid' => 'string',
        'date' => 'datetime',
        'published_at' => 'datetime',
        'active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'content_blocks' => 'array',
        'footer_blocks' => 'array',
    ];
}
