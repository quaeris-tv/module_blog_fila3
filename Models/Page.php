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
        'sidebar_blocks',
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
        'sidebar_blocks' => 'array',
        'footer_blocks' => 'array',
    ];

    /**
     * Get the path key to the item for the frontend only.
     *
     * @return string
     */
    public function getFrontRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the path key to the item for the frontend only.
     *
     * @return string
     */
    public function getUrl()
    {
        return url('/'.app()->getLocale().'/pages/'.$this->slug);
    }
}
