<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * Modules\Blog\Models\CategoryPost.
 *
<<<<<<< HEAD
 * @property string                          $id
=======
 * @property int                             $id
>>>>>>> dev
 * @property int                             $category_id
 * @property int                             $post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
<<<<<<< HEAD
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost withoutTrashed()
=======
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost   query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost   whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost   whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost   whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost   wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost   whereUpdatedAt($value)
 * @method static \Modules\Blog\Database\Factories\CategoryPostFactory factory($count = null, $state = [])
 *
 * @property string|null $updated_by
 * @property string|null $created_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereUpdatedBy($value)
>>>>>>> dev
 *
 * @mixin \Eloquent
 */
class CategoryPost extends BasePivot
{
    protected $fillable = ['category_id', 'post_id'];
}
