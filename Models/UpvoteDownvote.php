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
 * @method static \Modules\Blog\Database\Factories\UpvoteDownvoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   query()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereIsUpvote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote   withoutTrashed()
 *
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpvoteDownvote whereUpdatedBy($value)
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null                                                                $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null                                                                $updater
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 *
 * @mixin \Eloquent
 */
class UpvoteDownvote extends BaseModel
{
    protected $fillable = ['is_upvote', 'post_id', 'user_id'];
}
