<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Modules\Blog\Events\BetArticle;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\User\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
 * @property float $credits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rating> $ratings
 * @property-read int|null $ratings_count
 * @property-read User|null $user
 * @method static Builder|Profile whereCredits($value)
 * @mixin \Eloquent
 */
class Profile extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'id',
        'user_id',
        'email',
        'first_name',
        'last_name',
        'credits',
    ];

    /**
     * Get the user's first name.
     */
    protected function email(): Attribute
    {
        // return Attribute::make(
        //     get: fn (string $value) => ucfirst($value),
        // );

        return new Attribute(
            get: static function ($value, $attributes): string {
                dddx([$value, $attributes]);
                // $words = Str::wordCount(strip_tags((string) $attributes['body']));
                // $minutes = ceil($words / 200);

                // return $minutes.' '.str('min')->plural((int) $minutes).', '
                //     .$words.' '.str('word')->plural($words);
            }
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Post>
     */
    public function articles()
    {
        return $this->hasMany(Post::class);
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
    public function getRouteKeyName()
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
