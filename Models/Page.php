<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * Modules\Blog\Models\Page.
 *
 * @property string                          $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string                          $slug
 * @property string                          $title
 * @property string                          $content
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 * @property array|null                      $content_blocks
 * @method static \Modules\Blog\Database\Factories\PageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Page   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Page   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereContentBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Page   withoutTrashed()
 * @property array|null $sidebar_blocks
 * @property array $footer_blocks
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereFooterBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSidebarBlocks($value)
 * @mixin \Eloquent
 */
class Page extends BaseModel
{
    protected $fillable = [
        'content',
        'slug',
        'title',
        'content_blocks',
        'sidebar_blocks',
        'footer_blocks',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'images' => 'array',
        'id' => 'string',
        'uuid' => 'string',
        'date' => 'datetime',
        'published_at' => 'datetime',
        'active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'content_blocks' => 'array',
        'sidebar_blocks' => 'array',
        'footer_blocks' => 'array',
    ];

    /**
     * Get the path key to the item for the frontend only.
     *
     * @return string
     */
    public function getFrontRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the path key to the item for the frontend only.
     *
     * @return string
     */
    public function getUrl()
    {
        return url('/'.app()->getLocale().'/pages/'.$this->slug);
    }
}
