<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

class UpvoteDownvote extends BaseModel
{
    protected $fillable = ['is_upvote', 'post_id', 'user_id'];
}
