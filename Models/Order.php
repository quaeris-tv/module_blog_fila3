<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * Modules\Blog\Models\Order.
 *
 * @property date                            $date
 * @property string                          $article_id
 * @property string                          $rating_id
 * @property int                             $credits
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 * @property string|null                     $model_type
 * @property int|null                        $model_id
 * @method static \Modules\Blog\Database\Factories\OrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Order   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereRatingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order   withoutTrashed()
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 * @mixin \Eloquent
 */
class Order extends BaseModel
{
    protected $fillable = ['date', 'model_type', 'model_id', 'rating_id', 'credits'];
}
