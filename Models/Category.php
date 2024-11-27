<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Blog\Actions\ParentChilds\GetTreeOptions;
use Spatie\Translatable\HasTranslations;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

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
 * @property \Illuminate\Database\Eloquent\Collection<int, Article>                                                     $articles
 * @property int|null                                                                                                   $articles_count
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Modules\Media\Models\Media> $media
 * @property int|null                                                                                                   $media_count
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
 * @property array|null                                                       $description
 * @property \Illuminate\Support\Carbon|null                                  $deleted_at
 * @property string|null                                                      $deleted_by
 * @property string|null                                                      $parent_id
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $children
 * @property int|null                                                         $children_count
 * @property Category|null                                                    $parent
 * @property mixed                                                            $post_counter
 * @property mixed                                                            $translations
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $ancestors                  The model's recursive parents.
 * @property int|null                                                         $ancestors_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $ancestorsAndSelf           The model's recursive parents and itself.
 * @property int|null                                                         $ancestors_and_self_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $bloodline                  The model's ancestors, descendants and itself.
 * @property int|null                                                         $bloodline_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $childrenAndSelf            The model's direct children and itself.
 * @property int|null                                                         $children_and_self_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $descendants                The model's recursive children.
 * @property int|null                                                         $descendants_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $descendantsAndSelf         The model's recursive children and itself.
 * @property int|null                                                         $descendants_and_self_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $parentAndSelf              The model's direct parent and itself.
 * @property int|null                                                         $parent_and_self_count
 * @property Category|null                                                    $rootAncestor               The model's topmost parent.
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $siblings                   The parent's other children.
 * @property int|null                                                         $siblings_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $siblingsAndSelf            All the parent's children.
 * @property int|null                                                         $siblings_and_self_count
 *
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        breadthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        depthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        doesntHaveChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        getExpressionGrammar()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        hasChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        hasParent()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        isLeaf()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        isRoot()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        tree($maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereDeletedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereDeletedBy($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereDepth($operator, $value = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereDescription($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereLocale(string $column, string $locale)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereLocales(string $column, array $locales)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereParentId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 *
 * @property string|null                                            $icon
 * @property Banner|null                                            $banner
 * @property \Illuminate\Database\Eloquent\Collection<int, Article> $categoryArticles
 * @property int|null                                               $category_articles_count
 *
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereIcon($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 *
 * @property string|null $name
 *
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category        whereName($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 *
 * @mixin \Eloquent
 */
class Category extends BaseModel
{
    use HasRecursiveRelationships;
    use HasTranslations;

    /** @var array<int, string> */
    public $translatable = [
        'title',
        'description',
    ];

    /** @var list<string> */
    protected $fillable = [
        'title',
        'slug',
        'name',
        'picture',
        'description',
        'parent_id',
        'in_leaderboard',
        'icon',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'uuid' => 'string',
            'title' => 'string',
            'slug' => 'string',
            'name' => 'string',
            'picture' => 'string',
            'description' => 'string',
            'parent_id' => 'string',
            'in_leaderboard' => 'boolean',
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'icon' => 'string',
        ];
    }

    public static function getTreeCategoryOptions(): array
    {
        $instance = new self();

        return app(GetTreeOptions::class)->execute($instance);
    }

    /**
     * Get the path key to the item for the frontend only.
     */
    public function getFrontRouteKeyName(): string
    {
        return 'slug';
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public function categoryArticles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    public function banner(): HasOne
    {
        return $this->hasOne(Banner::class);
    }
}
