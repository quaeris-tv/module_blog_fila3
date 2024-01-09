<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

class CategoryPost extends BasePivot
{
    protected $fillable = ['category_id', 'post_id'];
}
