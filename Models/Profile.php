<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\User\Models\BaseProfile;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

/**
 * Modules\Blog\Models\Profile.
 *
 * @property float                                                                                                         $credits
 * @property int                                                                                                           $id
 * @property string|null                                                                                                   $user_id
 * @property string|null                                                                                                   $first_name
 * @property string|null                                                                                                   $last_name
 * @property string|null                                                                                                   $email
 * @property \Illuminate\Support\Carbon|null                                                                               $created_at
 * @property \Illuminate\Support\Carbon|null                                                                               $updated_at
 * @property string|null                                                                                                   $updated_by
 * @property string|null                                                                                                   $created_by
 * @property string|null                                                                                                   $deleted_at
 * @property string|null                                                                                                   $deleted_by
 * @property string|null                                                                                                   $slug
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes|null                                                        $extra
 * @property \Illuminate\Database\Eloquent\Collection<int, Article>                                                        $articles
 * @property int|null                                                                                                      $articles_count
 * @property string                                                                                                        $avatar
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser>                                $deviceUsers
 * @property int|null                                                                                                      $device_users_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device>                                    $devices
 * @property int|null                                                                                                      $devices_count
 * @property string|null                                                                                                   $full_name
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media>    $media
 * @property int|null                                                                                                      $media_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\DeviceUser>                                $mobileDeviceUsers
 * @property int|null                                                                                                      $mobile_device_users_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Device>                                    $mobileDevices
 * @property int|null                                                                                                      $mobile_devices_count
 * @property \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property int|null                                                                                                      $notifications_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Permission>                                $permissions
 * @property int|null                                                                                                      $permissions_count
 * @property \Illuminate\Database\Eloquent\Collection<int, RatingMorph>                                                    $ratingMorphs
 * @property int|null                                                                                                      $rating_morphs_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Rating>                                                         $ratings
 * @property int|null                                                                                                      $ratings_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Role>                                      $roles
 * @property int|null                                                                                                      $roles_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Models\Team>                                      $teams
 * @property int|null                                                                                                      $teams_count
 * @property \Modules\Xot\Contracts\UserContract|null                                                                      $user
 * @property string|null                                                                                                   $user_name
 *
 * @method static \Modules\Blog\Database\Factories\ProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   newQuery()
 * @method static EloquentBuilder|BaseProfile                     permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   query()
 * @method static EloquentBuilder|BaseProfile                     role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereCredits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereExtra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile   whereUserId($value)
 * @method static EloquentBuilder|BaseProfile                     withExtraAttributes()
 * @method static EloquentBuilder|BaseProfile                     withoutPermission($permissions)
 * @method static EloquentBuilder|BaseProfile                     withoutRole($roles, $guard = null)
 *
 * @property \Modules\User\Models\DeviceUser                            $pivot
 * @property \Modules\User\Models\Membership                            $membership
 * @property \Illuminate\Database\Eloquent\Collection<int, Transaction> $transanctions
 * @property int|null                                                   $transanctions_count
 * @property \Modules\Xot\Contracts\ProfileContract|null                $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null                $updater
 * @property int                                                        $oauth_enable
 * @property int                                                        $credentials_enable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCredentialsEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOauthEnable($value)
 *
 * @mixin \Eloquent
 */
class Profile extends BaseProfile
{
    /** @var array<string, string> */
    public $casts = [
        'extra' => SchemalessAttributes::class,
    ];

    /** @var string */
    protected $connection = 'blog';

    /** @var list<string> */
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

    /** @var array */
    protected $schemalessAttributes = [
        'extra',
    ];

    /**
     * @return HasMany<Article>
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * @return HasMany<Transaction>
     */
    public function transanctions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id', 'user_id');
    }

    /**
     * Get the route key for the user.
     */
    public function getFrontRouteKeyName(): string
    {
        return 'slug';
    }

    public function getAvatarUrl(): string
    {
        if (null == $this->getFirstMediaUrl('photo_profile')) {
            return asset('modules/blog/img/no_user.webp');
        }

        return $this->getFirstMediaUrl('photo_profile');
    }

    public function ratings(): HasManyThrough
    {
        $firstKey = 'user_id';
        $secondKey = 'id';
        $localKey = 'user_id';
        $secondLocalKey = 'rating_id';

        return $this->hasManyThrough(Rating::class, RatingMorph::class, $firstKey, $secondKey, $localKey, $secondLocalKey);
        // ->withPivot(['value'])
    }

    public function ratingMorphs(): HasMany
    {
        return $this->hasMany(RatingMorph::class, 'user_id', 'user_id');
    }

    // : int
    public function getArticleTraded(): \Illuminate\Support\Collection
    {
        // ->get()
        // ->count()

        return RatingMorph::where('user_id', $this->user_id)
            ->groupBy('model_id')
            ->pluck('model_id');
    }
}
