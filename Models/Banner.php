<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Spatie\Image\Manipulations;
use Modules\Blog\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Modules\Blog\Models\Menu.
 *
 * @property int                             $id
 * @property string                          $name
 * @property array|null                      $items
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 *
 * @method static \Modules\Blog\Database\Factories\MenuFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Banner extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    // use HasTranslations;

    /** @var array<int, string> */
    protected $fillable = [
        // "id", //: 40,
        // "desktop_thumbnail",//: "https://futuur-media-production.s3.amazonaws.com/cache/7a/9c/7a9c8f672e3499d573f24901280952f3.jpg",
        // "mobile_thumbnail",//: "https://futuur-media-production.s3.amazonaws.com/cache/0d/0c/0d0cf75bd794283b4606e85cc30f0045.jpg",
        // "desktop_thumbnail_webp",//: "https://futuur-media-production.s3.amazonaws.com/cache/64/3f/643f313db56c3735d15ae3eb1c27d5ad.webp",
        // "mobile_thumbnail_webp",//: "https://futuur-media-production.s3.amazonaws.com/cache/14/8c/148c10ea338dfbe1bbd329e551afbfcf.webp",
        'link', // : "https://futuur.com/q/category/99/usa",
        'title', // : "American Politics",
        'description', // : "Congress, White House, Elections and more",
        'action_text', // : "Make Your Forecasts",
        'category_id',
        /*
        "category",//: 99,
        "category_dict": {
            "id": 99,
            "title": "USA",
            "slug": "usa",
            "parent": 98,
            "in_leaderboard": false,
            "icon": null
        },
        */
        'start_date', // : null,
        'end_date', // : null,
        'hot_topic', // : false,
        'open_markets_count', // : 119,
        'landing_banner', // : false
    ];

    /** @var array<string, string> */
    protected $casts = [
        'id' => 'string',
        'desktop_thumbnail' => 'string',
        'mobile_thumbnail' => 'string',
        'desktop_thumbnail_webp' => 'string',
        'mobile_thumbnail_webp' => 'string',
        'link' => 'string',
        'title' => 'string',
        'description' => 'string',
        'action_text' => 'string',
        'category_id' => 'string',
        /*
        "category",//: 99,
        "category_dict": {
            "id": 99,
            "title": "USA",
            "slug": "usa",
            "parent": 98,
            "in_leaderboard": false,
            "icon": null
        },
        */
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'hot_topic' => 'boolean',
        'open_markets_count' => 'integer',
        'landing_banner' => 'boolean',
    ];

    /** @var array<int, string> */
    protected $appends = [
        'desktop_thumbnail',
        'mobile_thumbnail',
        'desktop_thumbnail_webp',
        'mobile_thumbnail_webp',
    ];

    // /**
    //  * @var array<int, string>
    //  */
    // public $translatable = [
    //   'title',
    //   'short_description',
    //   'action_text'
    // ];

    // /**
    //  * https://dev.to/npesado/convert-images-to-webp-4i06
    //  */
    // public function registerMediaConversions(?Media $media = null): void
    // {
    //     $this->addMediaConversion('cover')
    //         ->format(Manipulations::FORMAT_WEBP)
    //         ->width(320)
    //         ->height(200)
    //         ->nonQueued();
    // }

    public function getDesktopThumbnailAttribute(): string
    {
        return $this->getFirstMediaUrl('banner');
    }

    public function getMobileThumbnailAttribute(): string
    {
        return $this->getFirstMediaUrl('banner');
    }

    public function getDesktopThumbnailWebpAttribute(): string
    {
        return $this->getFirstMediaUrl('banner');
        // $urlToFirstImage = $course->getFirstMediaUrl('images', 'cover');
    }

    public function getMobileThumbnailWebpAttribute(): string
    {
        return $this->getFirstMediaUrl('banner');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

/*
"id": 40,
    "desktop_thumbnail":
      "https://futuur-media-production.s3.amazonaws.com/cache/7a/9c/7a9c8f672e3499d573f24901280952f3.jpg",
    "mobile_thumbnail":
      "https://futuur-media-production.s3.amazonaws.com/cache/0d/0c/0d0cf75bd794283b4606e85cc30f0045.jpg",
    "desktop_thumbnail_webp":
      "https://futuur-media-production.s3.amazonaws.com/cache/64/3f/643f313db56c3735d15ae3eb1c27d5ad.webp",
    "mobile_thumbnail_webp":
      "https://futuur-media-production.s3.amazonaws.com/cache/14/8c/148c10ea338dfbe1bbd329e551afbfcf.webp",
    "link": "https://futuur.com/q/category/99/usa",
    "title": "American Politics",
    "short_description": "Congress, White House, Elections and more",
    "action_text": "Make Your Forecasts",
    "category": 99,
    "category_dict": {
      "id": 99,
      "title": "USA",
      "slug": "usa",
      "parent": 98,
      "in_leaderboard": false,
      "icon": null
    },
    "end_date": null,
    "hot_topic": false,
    "open_markets_count": 119,
    "landing_banner": false
*/