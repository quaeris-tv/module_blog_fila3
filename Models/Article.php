<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStatus\HasStatuses;
use Spatie\Tags\HasTags;
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
 * @mixin \Eloquent
 */
class Article extends BaseModel implements Feedable, HasMedia
{
    use HasStatuses;
    use HasTags;
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        // 'description',
        'body',
        'images',
        'viewCount',

        'content_blocks',
        'footer_blocks',
        'is_featured',
        'main_image_upload',
        'main_image_url',
        'published_at',

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
     * @var array<string, string>
     */
    protected $casts = [
        // 'images' => 'array',
        'date' => 'datetime',
        'published_at' => 'datetime',
        'active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'content_blocks' => 'array',
        'footer_blocks' => 'array',
    ];

    // public function path()
    // {
    //    return "/article/$this->slug";
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            ->withTimestamps();
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

    /**
     * Get the article's description.
     */
    protected function description(): Attribute
    {
        return new Attribute(
            get: static function ($value, $attributes): string {
                // dddx([$value, $attributes, $attributes['content_blocks']]);
                // dddx(collect(json_decode($attributes['content_blocks']))->where('type', 'paragraph')->first()->data->text);
                $string = collect(json_decode($attributes['content_blocks']))->where('type', 'paragraph')->first()->data->text;

                return strip_tags(substr($string, 0, 100)).'...';
            }
        );
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

    /**
     * Get the route key for the article.
     *
     * @return string
     */
    // public function getRouteKeyName()
    // {
    //    return 'slug';
    // }

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
