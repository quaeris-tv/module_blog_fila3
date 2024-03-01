<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\User\Models\Traits\IsProfileTrait;
use Modules\User\Models\User;
// use Spatie\SchemalessAttributes\SchemalessAttributesTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

/**
 * Modules\Blog\Models\Profile.
 *
 * @property int                                                                                                        $id
 * @property string|null                                                                                                $user_id
 * @property string|null                                                                                                $first_name
 * @property string|null                                                                                                $last_name
 * @property string|null                                                                                                $email
 * @property Carbon|null                                                                                                $created_at
 * @property Carbon|null                                                                                                $updated_at
 * @property string|null                                                                                                $updated_by
 * @property string|null                                                                                                $created_by
 * @property Carbon|null                                                                                                $deleted_at
 * @property string|null                                                                                                $deleted_by
 * @property \Illuminate\Database\Eloquent\Collection<int, Post>                                                        $articles
 * @property int|null                                                                                                   $articles_count
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 *
 * @method static \Modules\Blog\Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static Builder|Profile                                 newModelQuery()
 * @method static Builder|Profile                                 newQuery()
 * @method static Builder|Profile                                 onlyTrashed()
 * @method static Builder|Profile                                 profileIsAuthor()
 * @method static Builder|Profile                                 query()
 * @method static Builder|Profile                                 whereCreatedAt($value)
 * @method static Builder|Profile                                 whereCreatedBy($value)
 * @method static Builder|Profile                                 whereDeletedAt($value)
 * @method static Builder|Profile                                 whereDeletedBy($value)
 * @method static Builder|Profile                                 whereEmail($value)
 * @method static Builder|Profile                                 whereFirstName($value)
 * @method static Builder|Profile                                 whereId($value)
 * @method static Builder|Profile                                 whereLastName($value)
 * @method static Builder|Profile                                 whereUpdatedAt($value)
 * @method static Builder|Profile                                 whereUpdatedBy($value)
 * @method static Builder|Profile                                 whereUserId($value)
 * @method static Builder|Profile                                 withTrashed()
 * @method static Builder|Profile                                 withoutTrashed()
 *
 * @property float                                                  $credits
 * @property \Illuminate\Database\Eloquent\Collection<int, Rating>  $ratings
 * @property int|null                                               $ratings_count
 * @property User|null                                              $user
 * @property string                                                 $slug
 * @property string                                                 $user_name
 * @property \Illuminate\Database\Eloquent\Collection<string, bool> $extra
 *
 * @method static Builder|Profile whereCredits($value)
 *
 * @mixin \Eloquent
 */
class Profile extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use IsProfileTrait;
    use SchemalessAttributesTrait;

    /** @var array<int, string> */
    protected $fillable = [
        'id',
        'user_id',
        'email',
        'first_name',
        'last_name',
        'credits',
        'slug',
        'extra',
    ];

    /** @var array<string, string> */
    public $casts = [
        'extra' => SchemalessAttributes::class,
    ];

    /** @var array */
    protected $schemalessAttributes = [
        'extra',
    ];

    public function scopeWithExtraAttributes(): Builder
    {
        return $this->extra->modelScope();
    }

    /**
     * @return HasMany<Article>
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get the route key for the user.
     *
     * @return string
     */
    public function getFrontRouteKeyName()
    {
        return 'slug';
    }

    public function ratings(): HasManyThrough
    {
        $firstKey = 'user_id';
        $secondKey = 'id';
        $localKey = 'user_id';
        $secondLocalKey = 'rating_id';

        return $this->hasManyThrough(Rating::class, RatingMorph::class, $firstKey, $secondKey, $localKey, $secondLocalKey)
            // ->withPivot(['value'])
        ;
    }
}
