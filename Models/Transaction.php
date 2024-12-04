<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Modules\Rating\Models\RatingMorph;
use Webmozart\Assert\Assert;

/**
 * @property int                             $id
 * @property string|null                     $model_type
 * @property int|null                        $model_id
 * @property int|null                        $credits
 * @property string|null                     $user_id
 * @property string|null                     $note
 * @property string|null                     $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 *
 * @method static \Modules\Blog\Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction   withoutTrashed()
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null                                                                $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null                                                                $updater
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 * @property float|null                                                                                                 $stocks_count
 * @property float|null                                                                                                 $stocks_value
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereStocksCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaction whereStocksValue($value)
 *
 * @mixin \Eloquent
 */
class Transaction extends BaseModel
{
    /** @var string */
    protected $connection = 'blog';

    protected $fillable = [
        'date',
        'model_type',
        'model_id',
        'user_id',
        'credits',
        'note',
        'stocks_count',
        'stocks_value',
    ];

    public function getRatingMorph(): RatingMorph
    {
        Assert::notNull($rating_morph = RatingMorph::where('rating_id', $this->model_id)->first());

        return $rating_morph;
    }
}
