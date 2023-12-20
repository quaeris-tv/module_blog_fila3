<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Support\Carbon;

/**
 * Modules\Blog\Models\PostView.
 *
 * @property int         $id
 * @property string      $ip_address
 * @property string      $user_agent
 * @property int         $post_id
 * @property int         $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostView   whereUserId($value)
 * @method static \Modules\Blog\Database\Factories\PostViewFactory factory($count = null, $state = [])
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
