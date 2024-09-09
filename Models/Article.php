<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Lang\Models\Contracts\HasTranslationsContract;
use Modules\Rating\Models\Contracts\HasRatingContract;
use Modules\Rating\Models\Rating;
use Modules\Rating\Models\Traits\HasRating;
use Modules\Xot\Contracts\UserContract;
use Safe\DateTime;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
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
 * @property UserContract|null                                                                                          $user
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
 * @method static EloquentBuilder|Article                         article(string $id)
 * @method static EloquentBuilder|Article                         author(string $profile_id)
 * @method static EloquentBuilder|Article                         category(string $id)
 * @method static EloquentBuilder|Article                         currentStatus(...$names)
 * @method static EloquentBuilder|Article                         differentFromCurrentArticle(string $current_article)
 * @method static \Modules\Blog\Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static EloquentBuilder|Article                         newModelQuery()
 * @method static EloquentBuilder|Article                         newQuery()
 * @method static EloquentBuilder|Article                         onlyTrashed()
 * @method static EloquentBuilder|Article                         otherCurrentStatus(...$names)
 * @method static EloquentBuilder|Article                         published()
 * @method static EloquentBuilder|Article                         publishedUntilToday()
 * @method static EloquentBuilder|Article                         query()
 * @method static EloquentBuilder|Article                         search(string $searching)
 * @method static EloquentBuilder|Article                         showHomepage()
 * @method static EloquentBuilder|Article                         tag(string $id)
 * @method static EloquentBuilder|Article                         withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static EloquentBuilder|Article                         withAllTagsOfAnyType($tags)
 * @method static EloquentBuilder|Article                         withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static EloquentBuilder|Article                         withAnyTagsOfAnyType($tags)
 * @method static EloquentBuilder|Article                         withTrashed()
 * @method static EloquentBuilder|Article                         withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static EloquentBuilder|Article                         withoutTrashed()
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
 * @property string|null                                                               $rewarded_at
 *
 * @method static EloquentBuilder|Article whereAuthorId($value)
 * @method static EloquentBuilder|Article whereCategoryId($value)
 * @method static EloquentBuilder|Article whereClosedAt($value)
 * @method static EloquentBuilder|Article whereContent($value)
 * @method static EloquentBuilder|Article whereContentBlocks($value)
 * @method static EloquentBuilder|Article whereCreatedAt($value)
 * @method static EloquentBuilder|Article whereCreatedBy($value)
 * @method static EloquentBuilder|Article whereDeletedAt($value)
 * @method static EloquentBuilder|Article whereDeletedBy($value)
 * @method static EloquentBuilder|Article whereDescription($value)
 * @method static EloquentBuilder|Article whereExcerpt($value)
 * @method static EloquentBuilder|Article whereFooterBlocks($value)
 * @method static EloquentBuilder|Article whereId($value)
 * @method static EloquentBuilder|Article whereIsFeatured($value)
 * @method static EloquentBuilder|Article whereLocale(string $column, string $locale)
 * @method static EloquentBuilder|Article whereLocales(string $column, array $locales)
 * @method static EloquentBuilder|Article whereMainImageUpload($value)
 * @method static EloquentBuilder|Article whereMainImageUrl($value)
 * @method static EloquentBuilder|Article wherePicture($value)
 * @method static EloquentBuilder|Article wherePublishedAt($value)
 * @method static EloquentBuilder|Article whereReadTime($value)
 * @method static EloquentBuilder|Article whereShowOnHomepage($value)
 * @method static EloquentBuilder|Article whereSlug($value)
 * @method static EloquentBuilder|Article whereStatus($value)
 * @method static EloquentBuilder|Article whereTitle($value)
 * @method static EloquentBuilder|Article whereUpdatedAt($value)
 * @method static EloquentBuilder|Article whereUpdatedBy($value)
 * @method static EloquentBuilder|Article whereUuid($value)
 *
 * @property int         $status_display
 * @property string|null $bet_end_date
 * @property string|null $event_start_date
 * @property string|null $event_end_date
 * @property int         $is_wagerable
 * @property int|null    $wagers_count
 * @property int|null    $wagers_count_canonical
 * @property int|null    $wagers_count_total
 * @property int|null    $wagers
 * @property string|null $brier_score
 * @property string|null $brier_score_play_money
 * @property string|null $brier_score_real_money
 * @property float|null  $volume_play_money
 * @property float|null  $volume_real_money
 * @property int         $is_following
 *
 * @method static EloquentBuilder|Article whereBetEndDate($value)
 * @method static EloquentBuilder|Article whereBrierScore($value)
 * @method static EloquentBuilder|Article whereBrierScorePlayMoney($value)
 * @method static EloquentBuilder|Article whereBrierScoreRealMoney($value)
 * @method static EloquentBuilder|Article whereEventEndDate($value)
 * @method static EloquentBuilder|Article whereEventStartDate($value)
 * @method static EloquentBuilder|Article whereIsFollowing($value)
 * @method static EloquentBuilder|Article whereIsWagerable($value)
 * @method static EloquentBuilder|Article whereSidebarBlocks($value)
 * @method static EloquentBuilder|Article whereStatusDisplay($value)
 * @method static EloquentBuilder|Article whereVolumePlayMoney($value)
 * @method static EloquentBuilder|Article whereVolumeRealMoney($value)
 * @method static EloquentBuilder|Article whereWagers($value)
 * @method static EloquentBuilder|Article whereWagersCount($value)
 * @method static EloquentBuilder|Article whereWagersCountCanonical($value)
 * @method static EloquentBuilder|Article whereWagersCountTotal($value)
 *
 * @property \Modules\Rating\Models\RatingMorph $pivot
 *
 * @method static EloquentBuilder|Article whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static EloquentBuilder|Article whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @method static EloquentBuilder|Article whereRewardedAt($value)
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @mixin \Eloquent
 */
class Article extends BaseModel implements Feedable, HasRatingContract, HasTranslationsContract
{
    use HasRating;
    use HasTags;
    use HasTranslations;

    /** @var array<int, string> */
    public $translatable = [
        'title',
        // 'description',
        'content_blocks',
        'sidebar_blocks',
        'footer_blocks',
    ];

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
        'rewarded_at',
    ];

    /**
     * return \Illuminate\Database\Eloquent\Collection<int, Article>.
     *
     * @return \Illuminate\Support\Collection<int, Article>
     */
    public static function getAllFeedItems()
    {
        return self::latest()->take(150)->get();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function orders(): MorphMany
    {
        return $this->morphMany(Order::class, 'model');
    }

    public function user(): BelongsTo
    {
        $user_class = \Modules\Xot\Datas\XotData::make()->getUserClass();

        return $this->belongsTo($user_class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ----- Feed ------
    public function toFeedItem(): FeedItem
    {
        Assert::notNull($this->user, '['.__LINE__.']['.__FILE__.']');

        return FeedItem::create()
            ->id($this->slug)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            // ->link($this->path()) //Call to an undefined method Modules\Blog\Models\Article::path()
            ->authorName($this->user?->name ?? 'Unknown');
    }

    public function shortBody(int $words = 30): string
    {
        return Str::words(strip_tags((string) $this->body), $words);
    }

    public function getFormattedDate(): string
    {
        Assert::notNull($this->published_at, '['.__LINE__.']['.__FILE__.']');

        return $this->published_at->format('F jS Y');
    }

    public function getThumbnail(): ?string
    {
        if (null !== $this->getMedia()->first()) {
            return $this->getMedia()->first()->getUrl();
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
            get: static function ($value, array $attributes): string {
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
     * @return EloquentBuilder
     */
    public function scopeDifferentFromCurrentArticle(EloquentBuilder $query, string $current_article)
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

    /*
     * NO !!
    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: static function ($value): string {
                return date_format(new DateTime($value), 'd/m/Y');
            }
        );
    }
    */

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

        if ($startDate > $endDate) {
            return 'expired';
            // return __('blog::article.single_expired');
            // return 'scaduto';
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

        if (0 === $month && 0 === $days && 0 === $hours && 0 === $minutes) {
            // return __('blog::article.single_expired');
            return 'scaduto';
            // return 'expired';
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
     */
    public function getFrontRouteKeyName(): string
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
     */
    public function scopeArticle(EloquentBuilder $query, string $id): EloquentBuilder
    {
        return $query->where('author_id', $id);
    }

    /**
     * Scope a query to only include published articles.
     */
    public function scopePublished(EloquentBuilder $query): EloquentBuilder|QueryBuilder
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
     * @param EloquentBuilder $query
     */
    public function scopeShowHomepage($query): EloquentBuilder
    {
        return $query->where('show_on_homepage', 1);
    }

    /**
     * Scope a query to only include posted articles until today.
     */
    public function scopePublishedUntilToday(EloquentBuilder $query): EloquentBuilder|QueryBuilder
    {
        return $query->whereDate('published_at', '<=', Carbon::today()->toDateString());
    }

    /**
     * Scope a query to only include articles with a specified category.
     *
     * @param $id -> The id of the category
     */
    public function scopeCategory(EloquentBuilder $query, string $id): EloquentBuilder
    {
        return $query->whereHas('category', static function ($q) use ($id): void {
            $q->where('id', $id);
        });
    }

    /**
     * Scope a query to only include articles that belongs to an author.
     *
     * @param $profile_id -> The id of the author
     *
     * @return EloquentBuilder
     */
    public function scopeAuthor(EloquentBuilder $query, string $profile_id)
    {
        return $query->whereHas('author', static function ($q) use ($profile_id): void {
            $q->where('id', $profile_id);
        });
    }

    /**
     * Scope a query to only include articles with a specified tag.
     *
     * @param $id -> The id of the tag
     *
     * @return EloquentBuilder
     */
    public function scopeTag(EloquentBuilder $query, string $id)
    {
        return $query->whereHas('tags', static function ($q) use ($id): void {
            $q->where('id', $id);
        });
    }

    /**
     * Scope a query to only include articles which contains searching words.
     *
     * @param $searching -> The searching words
     */
    public function scopeSearch(EloquentBuilder $query, string $searching): EloquentBuilder
    {
        return $query->where('title', 'LIKE', "%{$searching}%")
            ->orWhere('content', 'LIKE', "%{$searching}%")
            ->orWhere('excerpt', 'LIKE', "%{$searching}%");
    }

    /**
     * This string will be used in notifications on what a new comment
     * was made.
     */
    public function commentableName(): string
    {
        return 'Commento';
    }

    /**
     * This URL will be used in notifications to let the user know
     * where the comment itself can be read.
     */
    public function commentUrl(): string
    {
        return '#';
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id'=>'string',
            'uuid'=>'string',
            // 'images' => 'array',
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

    // /**
    //  * Get the tags of the article
    //  *
    //  * @return \Illuminate\Database\Eloquent\Collection
    //  */
    // public function tags()
    // {
    //    return $this->belongsToMany(Tag::class);
    // }

    // /**
    //  * Get the comments of the article.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany<Comment>
    //  */
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }

    /**
     * Get the article's main image.
     */
    protected function mainImage(): Attribute
    {
        return new Attribute(
            get: static fn ($value, $attributes): string => $attributes['main_image_upload'] ?? $attributes['main_image_url'] ?? '#'
        );
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
            get: static function ($value, array $attributes): string {
                if (null === $value || '' === $value) {
                    return 'article\'s description '.$attributes['title'];
                }

                return $value;
            }
        );
    }
}
