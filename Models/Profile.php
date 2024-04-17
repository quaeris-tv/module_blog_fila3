<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\User\Models\Traits\IsProfileTrait;
use Modules\User\Models\User;
// use Spatie\SchemalessAttributes\SchemalessAttributesTrait;
use Modules\Xot\Contracts\ModelWithUserContract;
use Modules\Xot\Contracts\ProfileContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
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
class Profile extends BaseModel implements HasMedia, ProfileContract, ModelWithUserContract
{
    use HasRoles;
    use InteractsWithMedia;
    use IsProfileTrait;
    use SchemalessAttributesTrait;
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Storage;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\User\Models\User;
// use Spatie\SchemalessAttributes\SchemalessAttributesTrait;
use Modules\Xot\Models\BaseProfile as XotBaseProfile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Profile extends XotBaseProfile implements HasMedia
{
    use InteractsWithMedia;

    /** @var string */
    protected $connection = 'blog';
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083

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

<<<<<<< HEAD
    public function scopeWithExtraAttributes(): Builder
    {
        return $this->extra->modelScope();
    }

=======
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
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

<<<<<<< HEAD
=======
    public function getAvatarUrl(): string
    {
        if (isset($this->extra->photo_profile)) {
            return Storage::disk('uploads')->url($this->extra->photo_profile);
        }

        if (null == $this->getFirstMediaUrl('photo_profile')) {
            // in caso eseguire php artisan module:publish
            // dddx($this);
            // dddx(asset('blog/img/no_user.webp'));
            return asset('modules/blog/img/no_user.webp');
        }

        return $this->getFirstMediaUrl('photo_profile');
    }

>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
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

    public function getArticleTraded() // : int
    {$result = RatingMorph::where('user_id', $this->user_id)
                ->groupBy('model_id')
                ->pluck('model_id')
                // ->get()
                // ->count()
        ;

        return $result;
    }
}
