<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Support\Carbon;

class PostView extends BaseModel
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'post_id',
        'user_id',
    ];
}
