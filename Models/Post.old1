<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStatus\HasStatuses;
use Spatie\Tags\HasTags;
use Webmozart\Assert\Assert;

/**
 * Modules\Blog\Models\Post.
 *
 * @property int                                            $id
 * @property string                                         $title
 * @property string                                         $slug
 * @property string|null                                    $thumbnail
 * @property string                                         $body
 * @property int                                            $active
 * @property \Illuminate\Support\Carbon|null                $published_at
 * @property string                                         $user_id
 * @property \Illuminate\Support\Carbon|null                $created_at
 * @property \Illuminate\Support\Carbon|null                $updated_at
 * @property string|null                                    $meta_title
 * @property string|null                                    $meta_description
 * @property Collection<int, \Modules\Blog\Models\Category> $categories
 * @property int|null                                       $categories_count
 * @property string                                         $human_read_time
 * @property User|null                                      $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Post   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post   whereUserId($value)
 * @method static \Modules\Blog\Database\Factories\PostFactory factory($count = null, $state = [])
 *
 * @property string|null                                                                                                $updated_by
 * @property string|null                                                                                                $created_by
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
class Post extends BaseModel implements HasMedia
{
    use HasStatuses;
    use HasTags;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'body',
        'user_id',
        'active',
        'published_at',
        'meta_title',
        'meta_description',
        /*
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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
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

                return $minutes.' '.str('min')->plural($minutes).', '
                    .$words.' '.str('word')->plural($words);
            }
        );
    }

    /**
     * Scope a query to only include articles different from current article
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

    /**
     * Get the tags of the article
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    // public function tags()
    // {
    //    return $this->belongsToMany(Tag::class);
    // }

    /**
     * Get the comments of the article
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
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
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope a query to only include articles
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
     * Scope a query to only include published articles
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        // return $query->where('status', 'published');
        return $query->currentStatus('published');
    }

    /**
     * Scope a query to only include show on homepage articles
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
     * Scope a query to only include posted articles until today
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
     * Scope a query to only include articles with a specified category
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
     * Scope a query to only include articles that belongs to an author
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $profile_id    -> The id of the author
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
     * Scope a query to only include articles with a specified tag
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
     * Scope a query to only include articles which contains searching words
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
