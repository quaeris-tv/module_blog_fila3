<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * Modules\Blog\Models\PostView.
 *
 * @property int                             $id
 * @property string                          $ip_address
 * @property string                          $user_agent
 * @property int                             $post_id
 * @property int                             $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Modules\Blog\Database\Factories\PostViewFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   withoutTrashed()
 *
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PostView whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView whereUpdatedBy($value)
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null                                                                $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null                                                                $updater
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 *
 * @mixin \Eloquent
 */
class PostView extends BaseModel
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'post_id',
        'user_id',
    ];
}
