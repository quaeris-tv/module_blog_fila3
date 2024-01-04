<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

class Menu extends BaseModel
{
    protected $fillable = [
        'name',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
