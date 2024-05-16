<?php
/**
 * ---.
 */

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

/**
 * @property string|null $parent_id
 * @property string      $name
 */
abstract class BaseTreeModel extends BaseModel
{
    use HasRecursiveRelationships;
    use Concerns\HasPathByParentId;
    use SortableTrait;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'parent_id' => 'string',
            'path' => 'string',
            'breads' => 'string',
            'root_name' => 'string',
            'is_leaf' => 'boolean',
            'ordering' => 'integer',
            'deleted_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getDepthName(): string
    {
        return 'cte_depth';
    }

    public function getPathName(): string
    {
        return 'cte_path';
    }

    public function makeChildOf(Model $parent): self
    {
        // if ($node->isSelfOrDescendantOf($this)) {
        //    throw new MoveNotPossibleException('Cannot make unit descendant of itself');
        // }

        // Save the previous parent to be used when finishing.
        $this->parent()->associate($parent);

        $this->save();

        return $this;
    }
}
