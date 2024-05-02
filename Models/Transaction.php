<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

class Transaction extends BaseModel
{
    /** @var string */
    protected $connection = 'blog';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['date', 'model_type', 'model_id', 'user_id', 'credits', 'note'];
}
