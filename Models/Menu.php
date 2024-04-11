<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Modules\Blog\Actions\ParentChilds\GetTreeOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Modules\Blog\Models\Menu.
 *
 * @property int                             $id
 * @property string                          $name
 * @property array|null                      $items
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 *
 * @method static \Modules\Blog\Database\Factories\MenuFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu   withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Menu extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    /** @var array<int, string> */
    protected $fillable = [
        'title',
        'items',
        'parent_id',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'items' => 'array',
    ];

    public static function getTreeMenuOptions(): array
    {
        $instance = new self();

        return app(GetTreeOptions::class)->execute($instance);

        // $categories = self::tree()->get()->toTree();
        // $results = [];
        // foreach ($categories as $cat) {
        //     $results[$cat->id] = $cat->title;
        //     foreach ($cat->children as $child) {
        //         $results[$child->id] = '--------->'.$child->title;
        //         foreach ($child->children as $cld) {
        //             $results[$cld->id] = '----------------->'.$cld->title;
        //             foreach ($cld->children as $c) {
        //                 $results[$c->id] = '------------------------->'.$c->title;
        //             }
        //         }
        //     }
        // }

        // return $results;
    }
}
