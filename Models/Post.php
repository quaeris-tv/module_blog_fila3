<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Modules\User\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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
    use InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'thumbnail', 'body', 'user_id', 'active', 'published_at', 'meta_title', 'meta_description'];

    protected $casts = [
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
            get: function ($value, $attributes): string {
                $words = Str::wordCount(strip_tags((string) $attributes['body']));
                $minutes = ceil($words / 200);

                return $minutes.' '.str('min')->plural($minutes).', '
                    .$words.' '.str('word')->plural($words);
            }
        );
    }
}
