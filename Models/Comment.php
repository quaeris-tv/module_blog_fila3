<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\User\Models\User;

/**
 * App\Models\Comment.
 *
 * @property int                             $id
 * @property string                          $comment
 * @property int                             $post_id
 * @property int                             $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null                        $parent_id
 * @property Comment|null                    $parentComment
 * @property \Modules\Blog\Models\Post|null  $post
 * @property User|null                       $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property int|null                                               $comments_count
 *
 * @method static \Modules\Blog\Database\Factories\CommentFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
class Comment extends BaseModel
{
    protected $fillable = [
        'comment',
        'post_id',
        'user_id',
        'parent_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function comments(): HasMany
    {
        // return $this->hasMany(Comment::class, function ($query) {
        //     $query->whereNotNull('parent_id')->orderBy('created_at', 'desc');
        // });

        return $this->hasMany(self::class)
            ->whereNotNull('parent_id')
            ->orderBy('created_at', 'desc');
    }
}
