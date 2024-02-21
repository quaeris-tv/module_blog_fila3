<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Webmozart\Assert\Assert;
use Modules\User\Models\User;
use Illuminate\Support\Carbon;
use Modules\Rating\Models\Rating;
use Spatie\MediaLibrary\HasMedia;
use Modules\Blog\Events\BetArticle;
use Modules\Rating\Models\RatingMorph;
use Illuminate\Database\Eloquent\Builder;
use Modules\Xot\Contracts\ProfileContract;
use Spatie\MediaLibrary\InteractsWithMedia;
use Modules\User\Models\Traits\IsProfileTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Spatie\SchemalessAttributes\SchemalessAttributesTrait;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

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
 * @property float                                                 $credits
 * @property \Illuminate\Database\Eloquent\Collection<int, Rating> $ratings
 * @property int|null                                              $ratings_count
 * @property User|null                                             $user
 * @property string                                                $slug
 * @property string                                                $user_name
 * @property \Illuminate\Database\Eloquent\Collection<string, bool> $extra
 *
 * @method static Builder|Profile whereCredits($value)
 *
 * @mixin \Eloquent
 */
class Profile extends BaseModel implements HasMedia
{
    use IsProfileTrait;
    use InteractsWithMedia;
    // use SchemalessAttributesTrait;

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

    public $casts = [
        'extra' => SchemalessAttributes::class,
    ];

    public function scopeWithExtraAttributes(): Builder
    {
        return $this->extra->modelScope();
    }

    /*
     * Get the user's first name.
     */
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: function ($value): string {
                if (null == $value) {
                    $value = 'Mio Nome';
                }
                Assert::string($value);

                return $value;
            }
        );
    }

    /*
     * Get the user's last name.
     */
    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: function ($value): string {
                if (null == $value) {
                    $value = 'Mio Cognome';
                }
                Assert::string($value);

                return $value;
            }
        );
    }

    /*
     * Get the user's full name.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $value = $this->first_name.' '.$this->last_name;

                return $value;
            }
        );
    }

    /*
     * Get the user's user_name.
     */
    protected function userName(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                Assert::notNull($user = $this->user);
                $value = $user->name;

                return $value;
            }
        );
    }

    /*
     * Get the user's avatar.
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                $value = $this->getFirstMediaUrl('photo_profile');

                return $value;
            }
        );
    }

    /**
     * Get the user's email.
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            get: function ($value): string {
                if (null == $value) {
                    Assert::notNull($this->user);
                    $this->email = $this->user->email;
                    $this->update();
                    // Assert::string($value = $this->email);
                }
                Assert::string($value);

                return $value;
            }
        );
    }

    /**
     * Get the user's first name.
     */
    protected function slug(): Attribute
    {
        return Attribute::make(
            get: static function ($value, $attributes): string {
                Assert::notNull($user = \Auth::user());
                Assert::isInstanceOf($user, User::class);

                Assert::notNull($profile = $user->profile);
                // Assert::isInstanceOf($profile, ProfileContract::class);
                $profile->slug = str_slug(strtolower($user->name));
                $profile->update();

                return str_slug(strtolower($user->name));
            },
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Article>
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // /**
    //  * Get the path to the profile picture
    //  *
    //  * @return string
    //  */
    // public function profilePicture()
    // {
    //     if ($this->picture) {
    //         return "/storage/{$this->picture}";
    //     }

    //     return 'http://i.pravatar.cc/200';
    // }

    /**
     * Get the route key for the user.
     *
     * @return string
     */
    public function getFrontRouteKeyName()
    {
        return 'slug';
    }

    // /**
    //  * Check if the user has admin role
    //  *
    //  * @return bool
    //  */
    // public function isAdmin()
    // {
    //     return 1 === $this->role_id;
    // }

    // /**
    //  * Check if the user has creator role
    //  *
    //  * @return bool
    //  */
    // public function isAuthor()
    // {
    //     return 2 === $this->role_id;
    // }

    // /**
    //  * Check if the user has user role
    //  *
    //  * @return bool
    //  */
    // public function isMember()
    // {
    //     return 3 === $this->role_id;
    // }

    /**
     * Scope a query to only include users that are authors.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeProfileIsAuthor($query)
    {
        return $query; // ->where('role_id', '=', 2);
    }

    // public function betArticle(array $attributes): void
    // {
    //     event(new BetArticle($attributes));
    // }

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
