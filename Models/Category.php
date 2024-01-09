<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Carbon\Carbon;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
=======
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
>>>>>>> dev

/**
 * Modules\Blog\Models\Category.
 *
<<<<<<< HEAD
 * @property int                                                                                                        $id
 * @property string                                                                                                     $title
 * @property string                                                                                                     $slug
 * @property \Illuminate\Support\Carbon|null                                                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                                                            $updated_at
 * @property string|null                                                                                                $updated_by
 * @property string|null                                                                                                $created_by
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Article>                                $articles
 * @property int|null                                                                                                   $articles_count
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Post>                                   $posts
 * @property int|null                                                                                                   $posts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Post>                                   $publishedPosts
 * @property int|null                                                                                                   $published_posts_count
 *
 * @method static \Modules\Blog\Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereCreatedBy($value)
=======
 * @property int                                                                      $id
 * @property string                                                                   $title
 * @property string                                                                   $slug
 * @property \Illuminate\Support\Carbon|null                                          $created_at
 * @property \Illuminate\Support\Carbon|null                                          $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Post> $posts
 * @property int|null                                                                 $posts_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Modules\Blog\Models\Post> $publishedPosts
 * @property int|null                                                                 $published_posts_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Category   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereCreatedAt($value)
>>>>>>> dev
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereUpdatedAt($value)
<<<<<<< HEAD
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Category extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'name',
        'slug',
        'picture',
        'description',
    ];
=======
 * @method static \Modules\Blog\Database\Factories\CategoryFactory factory($count = null, $state = [])
 *
 * @property string|null $updated_by
 * @property string|null $created_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
class Category extends BaseModel
{
    protected $fillable = ['title', 'slug'];
>>>>>>> dev

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

<<<<<<< HEAD
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

=======
>>>>>>> dev
    public function publishedPosts(): BelongsToMany
    {
        // return $this->belongsToMany(Post::class, function ($query) {
        //     $query->where('active', '=', 1)
        //         ->whereDate('published_at', '<', Carbon::now());
        // });
        return $this->posts()
<<<<<<< HEAD
            ->where('active', '=', 1)
            ->whereDate('published_at', '<', Carbon::now());
    }

    public function postCounter(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->publishedPosts()->count(),
        );
=======
                ->where('active', '=', 1)
                ->whereDate('published_at', '<', Carbon::now());
>>>>>>> dev
    }
}
