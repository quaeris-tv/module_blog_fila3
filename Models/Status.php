<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Eloquent;
use Spatie\ModelStatus\Status as BaseStatus;

/**
 * Modules\Blog\Models\Status.
 *
 * @property int                                           $id
 * @property string                                        $name
 * @property string|null                                   $reason
 * @property string                                        $model_type
 * @property int                                           $model_id
 * @property \Illuminate\Support\Carbon|null               $created_at
 * @property \Illuminate\Support\Carbon|null               $updated_at
 * @property string|null                                   $updated_by
 * @property string|null                                   $created_by
 * @property \Illuminate\Database\Eloquent\Model|\Eloquent $model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUpdatedBy($value)
 *
 * @property string $ip_address
 * @property string $user_agent
 * @property int    $post_id
 * @property int    $user_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUserId($value)
 *
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereDeletedBy($value)
 *
 * @mixin \Eloquent
 * @mixin Eloquent
 */
class Status extends BaseStatus
{
    /** @var string */
    protected $connection = 'blog';
}
