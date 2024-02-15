<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\User\Models\User;

/**
 * Modules\Blog\Models\Comment.
 *
 * @property int                                                    $id
 * @property string                                                 $comment
 * @property int                                                    $post_id
 * @property int                                                    $user_id
 * @property \Illuminate\Support\Carbon|null                        $created_at
 * @property \Illuminate\Support\Carbon|null                        $updated_at
 * @property int|null                                               $parent_id
 * @property Article|null                                           $article
 * @property Profile|null                                           $author
 * @property \Illuminate\Database\Eloquent\Collection<int, Comment> $childrens
 * @property int|null                                               $childrens_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property int|null                                               $comments_count
 * @property Comment|null                                           $parentComment
 * @property User|null                                              $user
 *
 * @method static \Modules\Blog\Database\Factories\CommentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment   withoutTrashed()
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
        'author_id',
        'article_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The comment that belong to the author.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'user_id'); // ->withTrashed();
    }


    /**
     * The comment that belong to the article.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * The childrens of a comment(reply).
     */
    public function childrens(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
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
