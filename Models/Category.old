<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modules\Blog\Models\Category.
 *
 * @property-read Collection<int, \Modules\Blog\Models\Post> $posts
 * @property-read int|null $posts_count
 * @method static Builder|Category isInvisible()
 * @method static Builder|Category isVisible()
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'blog_categories';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_visible',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'blog_category_id', 'id');
    }

    public function scopeIsVisible(Builder $query): Builder
    {
        return $query->whereIsVisible(true);
    }

    public function scopeIsInvisible(Builder $query): Builder
    {
        return $query->whereIsVisible(false);
    }
}
