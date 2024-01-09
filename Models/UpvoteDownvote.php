<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * Modules\Blog\Models\UpvoteDownvote.
 *
 * @property int                             $id
 * @property int                             $is_upvote
 * @property int                             $post_id
 * @property int                             $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * <<<<<<< HEAD
 * <<<<<<< HEAD
 *
 * =======
 * >>>>>>> ce72d0a (up)
 *
 * @method static \Modules\Blog\Database\Factories\UpvoteDownvoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   onlyTrashed()
 *                                                                                                           <<<<<<< HEAD
 *                                                                                                           =======
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   newQuery()
 *                                                                                                           >>>>>>> dev
 *                                                                                                           =======
 *                                                                                                           >>>>>>> ce72d0a (up)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   query()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereIsUpvote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereUserId($value)
 *                                                                                                           <<<<<<< HEAD
 *                                                                                                           <<<<<<< HEAD
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   withoutTrashed()
 *                                                                                                           =======
 * @method static \Modules\Blog\Database\Factories\UpvoteDownvoteFactory factory($count = null, $state = [])
 *                                                                                                           >>>>>>> dev
 *                                                                                                           =======
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   withoutTrashed()
 *                                                                                                           >>>>>>> ce72d0a (up)
 *
 * @mixin \Eloquent
 */
class UpvoteDownvote extends BaseModel
{
    protected $fillable = ['is_upvote', 'post_id', 'user_id'];
}
