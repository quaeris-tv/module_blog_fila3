<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modules\Blog\Models\Category.
 *
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
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereUpdatedAt($value)
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

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function publishedPosts(): BelongsToMany
    {
        // return $this->belongsToMany(Post::class, function ($query) {
        //     $query->where('active', '=', 1)
        //         ->whereDate('published_at', '<', Carbon::now());
        // });
        return $this->posts()
                ->where('active', '=', 1)
                ->whereDate('published_at', '<', Carbon::now());
    }
}
