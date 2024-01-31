<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * Modules\Blog\Models\Category.
 *
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
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category   withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Category extends BaseModel implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use HasTranslations;
    
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    protected $fillable = [
        'title',
        'slug',
        'name',
        'slug',
        'picture',
        'description',
        'parent_id',
    ];

    /**
     * @var array<int, string>
     */
    public $translatable = [
        'title',
        'description',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
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

    public function postCounter(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->publishedPosts()->count(),
        );
    }

    static function getTreeCategoryOptions(): array
    {
        $categories = Category::tree()->get()->toTree();
        $results = [];
        foreach($categories as $cat){
            $results[$cat->id] = $cat->title;
            foreach($cat->children as $child){
                $results[$child->id] = '----------------->'.$child->title;
            }
        }
        return $results;
    }
}
