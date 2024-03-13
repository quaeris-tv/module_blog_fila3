<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\User\Models\User;
// use Spatie\SchemalessAttributes\SchemalessAttributesTrait;
use Modules\Xot\Models\BaseProfile as XotBaseProfile;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Profile extends XotBaseProfile
{

     /** @var string */
    protected $connection = 'blog';

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
