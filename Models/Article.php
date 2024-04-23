<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\RatingMorph;
use Modules\User\Models\User;
use Safe\DateTime;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStatus\HasStatuses;
use Spatie\Searchable\Searchable;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;
use Webmozart\Assert\Assert;

/**
 * Modules\Blog\Models\Article.
 *
 * @property Profile|null                                                                                               $author
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Category>                               $categories
 * @property int|null                                                                                                   $categories_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Comment>                                $comments
 * @property int|null                                                                                                   $comments_count
 * @property string                                                                                                     $human_read_time
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Tag>                                    $tags
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                                  $statuses
 * @property int|null                                                                                                   $statuses_count
 * @property int|null                                                                                                   $tags_count
 * @property User|null                                                                                                  $user
 * @property string                                                                                                     $body
 * @property Carbon                                                                                                     $published_at
 * @property Carbon                                                                                                     $updated_at
 * @property string                                                                                                     $slug
 * @property string                                                                                                     $title
 * @property string                                                                                                     $description
 * @property string                                                                                                     $main_image_upload
 * @property string                                                                                                     $main_image_url
 * @property string                                                                                                     $content_blocks
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article   article(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   author(string $profile_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   category(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   currentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   differentFromCurrentArticle(string $current_article)
 * @method static \Modules\Blog\Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Article   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article   otherCurrentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   published()
 * @method static \Illuminate\Database\Eloquent\Builder|Article   publishedUntilToday()
 * @method static \Illuminate\Database\Eloquent\Builder|Article   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article   search(string $searching)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   showHomepage()
 * @method static \Illuminate\Database\Eloquent\Builder|Article   tag(string $id)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Article   withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Article   withoutTrashed()
 *
 * @property string                                                                    $id
 * @property string                                                                    $uuid
 * @property string|null                                                               $content
 * @property string|null                                                               $picture
 * @property int|null                                                                  $category_id
 * @property int|null                                                                  $author_id
 * @property string|null                                                               $status
 * @property int                                                                       $show_on_homepage
 * @property int|null                                                                  $read_time
 * @property string|null                                                               $excerpt
 * @property string                                                                    $created_at
 * @property \Illuminate\Support\Carbon|null                                           $deleted_at
 * @property string|null                                                               $updated_by
 * @property string|null                                                               $created_by
 * @property string|null                                                               $deleted_by
 * @property array|null                                                                $footer_blocks
 * @property array|null                                                                $sidebar_blocks
 * @property int                                                                       $is_featured
 * @property string|null                                                               $closed_at
 * @property Category|null                                                             $category
 * @property string                                                                    $main_image
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Order> $orders
 * @property int|null                                                                  $orders_count
 * @property \Illuminate\Database\Eloquent\Collection<int, Rating>                     $ratings
 * @property int|null                                                                  $ratings_count
 * @property mixed                                                                     $translations
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereContentBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereFooterBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereMainImageUpload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereMainImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereReadTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereShowOnHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUuid($value)
 *
 * @mixin \Eloquent
 */
class Article extends BaseModel implements Feedable, HasMedia // , Searchable
{use HasStatuses;
    use HasTags;
    use HasTranslations;
    use InteractsWithMedia;

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'slug',
        // 'description',
        'body',
        'images',
        'viewCount',

        'content_blocks',
        'footer_blocks',
        'sidebar_blocks',
        'is_featured',
        'main_image_upload',
        'main_image_url',
        'published_at',
        'closed_at',
        'category_id',
        // 'is_closed', => closet_at

        /*
        'title',
        'slug',
        'thumbnail',
        'body',
        'user_id',
        'active',
        'published_at',
        'meta_title',
        'meta_description',

         'author_id',
        'title',
        'slug',
        'content',
        'picture',
        'category_id',
        'status',
        'publish_date',
        'show_on_homepage',
        'author_name',
        'read_time',
        'excerpt',
        */
        'status',
        'status_display',
        'bet_end_date',
        'event_start_date',
        'event_end_date',
        'is_wagerable',
        'brier_score',
        'brier_score_play_money',
        'brier_score_real_money',
        'wagers_count',
        'wagers_count_canonical',
        'wagers_count_total',
        'wagers',
        'volume_play_money',
        'volume_real_money',
        'is_following',
    ];

    /** @var array<int, string> */
    public $translatable = [
        'title',
        // 'description',
        'content_blocks',
        'sidebar_blocks',
        'footer_blocks',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @return array<string, string> */
    protected function casts(): array
    {
        return [
            // 'images' => 'array',
            'id' => 'string',
            'uuid' => 'string',
            'date' => 'datetime',
            'published_at' => 'datetime',
            'active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'closed_at' => 'datetime',
            'content_blocks' => 'array',
            'footer_blocks' => 'array',
            'sidebar_blocks' => 'array',
            // 'is_closed'=> 'boolean',
        ];
    }

    // public function path()
    // {
    //    return "/article/$this->slug";
    // }

    // public function getSearchResult(): SearchResult
    // {
    //     $url = route('test', ['lang'=>'it']);

    //     return new \Spatie\Searchable\SearchResult(
    //        $this,
    //        $this->title,
    //        $url
    //     );
    // }

    public function orders(): MorphMany
    {
        return $this->morphMany(Order::class, 'model');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings(): MorphToMany
    {
        $pivot_class = RatingMorph::class;
        $pivot = app($pivot_class);
        $pivot_table = $pivot->getTable();
        $pivot_db_name = $pivot->getConnection()->getDatabaseName();
        $pivot_table_full = $pivot_db_name.'.'.$pivot_table;
        $pivot_fields = $pivot->getFillable();

        return $this->morphToMany(Rating::class, 'model', $pivot_table_full)
            ->using($pivot_class)
            ->withPivot($pivot_fields)
            ->withTimestamps();
    }

    public function getOptionRatingsIdTitle(): array
    {
        // return $this->ratings()->where('user_id', null)->get();
        return Arr::pluck($this->ratings()->where('user_id', null)->get()->toArray(), 'title', 'id');
    }

    public function getOptionRatingsIdColor(): array
    {
        // return $this->ratings()->where('user_id', null)->get();
        return Arr::pluck($this->ratings()->where('user_id', null)->get()->toArray(), 'color', 'id');
    }

    public function getArrayRatingsWithImage(): array
    {
        $ratings = $this
        ->ratings()
        // ->with('media')
        ->where('user_id', null)
        ->get()
        // ->toArray()
        ;

        $ratings_array = [];

        foreach ($ratings as $key => $rating) {
            $ratings_array[$key] = $rating->toArray();
            if (empty($rating->getFirstMediaUrl('rating'))) {
                $rating->addMediaFromUrl('https://picsum.photos/id/'.$rating->id.'/300/200')
                       ->toMediaCollection('rating');
            }
            $ratings_array[$key]['image'] = $rating->getFirstMediaUrl('rating');
            $ratings_array[$key]['effect'] = false;
        }

        return $ratings_array;
    }

    public function getBettingUsers(): int
    {
        return count(RatingMorph::where('model_id', $this->id)
            ->where('user_id', '!=', null)
            ->groupBy('user_id')
            ->get()
            ->toArray());
    }

    public function getVolumeCredit(?int $rating_id = null): int
    {
        $ratings = RatingMorph::where('model_id', $this->id)
            ->where('user_id', '!=', null);

        if (null != $rating_id) {
            $ratings = $ratings->where('rating_id', $rating_id);
        }

        $ratings = $ratings->get();

        $tmp = 0;

        foreach ($ratings as $rating) {
            $tmp += $rating->value;
        }

        return $tmp;
    }

    public function getRatingsPercentage(): array
    {
        $ratings_options = $this->getOptionRatingsIdTitle();
        $result = [];

        foreach ($ratings_options as $key => $value) {
            $b = RatingMorph::where('model_id', $this->id)
                ->where('user_id', '!=', null)
                ->count();

            if (0 == $b) {
                $b = 1;
            }

            $a = RatingMorph::where('model_id', $this->id)
                ->where('user_id', '!=', null)
                ->where('rating_id', $key)
                ->count();

            $result[$key] = round((100 * $a) / $b, 0);
        }

        return $result;
    }

    // ----- Feed ------
    public function toFeedItem(): FeedItem
    {
        Assert::notNull($this->user);

        return FeedItem::create()
            ->id($this->slug)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            // ->link($this->path()) //Call to an undefined method Modules\Blog\Models\Article::path()
            ->authorName($this->user->name);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Article>
     */
    public static function getAllFeedItems()
    {
        return self::latest()->take(150)->get();
    }

    public function shortBody(int $words = 30): string
    {
        return Str::words(strip_tags((string) $this->body), $words);
    }

    public function getFormattedDate(): string
    {
        Assert::notNull($this->published_at);

        return $this->published_at->format('F jS Y');
    }

    public function getThumbnail(): ?string
    {
        if (null !== $this->getMedia()->first()) {
            $url = $this->getMedia()->first()->getUrl();

            return $url;
        }

        return '#';
        // if (str_starts_with((string) $this->thumbnail, 'http')) {
        //     return $this->thumbnail;
        // }

        // return '/storage/'.$this->thumbnail;
    }

    public function humanReadTime(): Attribute
    {
        return new Attribute(
            get: static function ($value, $attributes): string {
                $words = Str::wordCount(strip_tags((string) $attributes['body']));
                $minutes = ceil($words / 200);

                return $minutes.' '.str('min')->plural((int) $minutes).', '
                    .$words.' '.str('word')->plural($words);
            }
        );
    }

    /**
     * Scope a query to only include articles different from current article.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDifferentFromCurrentArticle($query, string $current_article)
    {
        return $query->where('id', '!=', $current_article);
    }

    /**
     * The author that belong to the article.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'user_id'); // ->withTrashed();
    }

    // /**
    //  * Get the tags of the article
    //  *
    //  * @return \Illuminate\Database\Eloquent\Collection
    //  */
    // public function tags()
    // {
    //    return $this->belongsToMany(Tag::class);
    // }

    /**
     * Get the comments of the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Comment>
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the article's main image.
     */
    protected function mainImage(): Attribute
    {
        return new Attribute(
            get: static function ($value, $attributes): string {
                return $attributes['main_image_upload'] ?? $attributes['main_image_url'] ?? '#';
            }
        );
    }

    public function getTitle(): string
    {
        if ($this->title) {
            return $this->title;
        }

        return 'Get Title of article id '.$this->id;
    }

    public function getMainImage(): string
    {
        if ($this->media) {
            // https://spatie.be/docs/laravel-medialibrary/v11/basic-usage/retrieving-media
            return $this->getFirstMediaUrl('main_image_upload');
        }

        if ($this->main_image_upload) {
            return Storage::url($this->main_image_upload);
        }

        if (null !== $this->main_image_url) {
            return $this->main_image_url;
        }

        return '#';
    }

    /**
     * Get the article's title.
     */
    protected function title(): Attribute
    {
        return new Attribute(
            get: static function ($value, $attributes): string {
                if (null === $value) {
                    return 'article title';
                }

                return $value;
            }
        );
    }

    /**
     * Get the article's description.
     */
    protected function description(): Attribute
    {
        return new Attribute(
            get: static function ($value, $attributes): string {
                if (null === $value || '' === $value) {
                    return 'article\'s description '.$attributes['title'];
                }

                return $value;
            }
        );
    }

    /**
     * Get the article's description.
     */
    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: static function ($value): string {
                return date_format(new DateTime($value), 'd/m/Y');
            }
        );
    }

    public function getUuidAttribute(?string $value): string
    {
        if (null !== $value && '' !== $value) {
            return $value;
        }
        // dddx($value);
        $value = (string) Str::uuid();
        $this->uuid = $value;
        $this->save();

        // return $value;

        return '##';
    }

    // public function getTimeLeft(): string
    // {
    //     $time = $this->closed_at;

    //     $days = Carbon::now()->diffInDays($time);
    //     $hours = Carbon::now()->copy()->addDays($days)->diffInHours($time);
    //     $minutes = Carbon::now()->copy()->addDays($days)->addHours($hours)->diffInMinutes($time);
    //     return $days.'d'.$hours.'m'.$minutes.'s';
    // }

    public function getTimeLeftForHumans(): ?string
    {
        $endDate = $this->closed_at;
        $startDate = Carbon::now();

        $end = Carbon::createFromDate($this->closed_at);
        if ($startDate > $end) {
            return 'scaduto';
        }

        // Calcola la differenza tra le due date
        $diff = $startDate->diff($endDate);

        // Ottieni il tempo rimasto in giorni, ore, minuti e secondi
        $month = $diff->m;

        if ($month > 0) {
            return null;
        }

        $days = $diff->d;
        $hours = $diff->h;
        $minutes = $diff->i;

        if (0 == $month && 0 == $days && 0 == $hours && 0 == $minutes) {
            return 'scaduto';
        }

        return "Tempo rimasto: $days giorni, $hours ore, $minutes minuti";
    }

    // /**
    //  * Get the path to the picture
    //  *
    //  * @return string
    //  */
    // public function path()
    // {
    //     return "/storage/{$this->picture}";
    // }

    // /**
    //  * Get the route key for the article.
    //  *
    //  * @return string
    //  */
    // public function getRouteKeyName()
    // {
    //     if (inAdmin()) {
    //         return $this->getKeyName();
    //     }

    //     return 'slug';
    // }

    /**
     * Get the path key to the item for the frontend only.
     *
     * @return string
     */
    public function getFrontRouteKeyName()
    {
        return 'slug';
    }

    /* ----
    public function getOnlyContentBlocks(array $name_blocks): array
    {
        $filtered = collect($this->content_blocks)->filter(function (array $value, int $key) use ($name_blocks) {
            foreach ($name_blocks as $block) {
                if ($value['type'] == $block) {
                    return $value;
                }
            }
        })->toArray();

        return $filtered;
    }

    public function getExceptContentBlocks(array $name_blocks): array
    {
        $filtered = collect($this->content_blocks)->filter(function (array $value, int $key) use ($name_blocks) {
            foreach ($name_blocks as $block) {
                if ($value['type'] != $block) {
                    return $value;
                }
            }
        })->toArray();

        return $filtered;
    }
    */

    /**
     * Scope a query to only include articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeArticle($query, string $id)
    {
        return $query->where('author_id', $id);
    }

    /**
     * Scope a query to only include published articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        // return $query->where('status', 'published');
        // return $query->currentStatus('published');
        return $query
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', Carbon::now());
    }

    /**
     * Scope a query to only include show on homepage articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShowHomepage($query)
    {
        return $query->where('show_on_homepage', 1);
    }

    /**
     * Scope a query to only include posted articles until today.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublishedUntilToday($query)
    {
        return $query->whereDate('published_at', '<=', Carbon::today()->toDateString());
    }

    /**
     * Scope a query to only include articles with a specified category.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $id    -> The id of the category
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategory($query, string $id)
    {
        return $query->whereHas('category', static function ($q) use ($id) {
            $q->where('id', $id);
        });
    }

    /**
     * Scope a query to only include articles that belongs to an author.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $profile_id -> The id of the author
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAuthor($query, string $profile_id)
    {
        return $query->whereHas('author', static function ($q) use ($profile_id) {
            $q->where('id', $profile_id);
        });
    }

    /**
     * Scope a query to only include articles with a specified tag.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $id    -> The id of the tag
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTag($query, string $id)
    {
        return $query->whereHas('tags', static function ($q) use ($id) {
            $q->where('id', $id);
        });
    }

    /**
     * Scope a query to only include articles which contains searching words.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $searching -> The searching words
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, string $searching)
    {
        return $query->where('title', 'LIKE', "%{$searching}%")
            ->orWhere('content', 'LIKE', "%{$searching}%")
            ->orWhere('excerpt', 'LIKE', "%{$searching}%");
    }
}
