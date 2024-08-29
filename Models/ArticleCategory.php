<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * Modules\Blog\Models\ArticleCategory.
 *
 * @property string                          $id
 * @property int                             $category_id
 * @property int                             $article_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $updated_by
 * @property string|null                     $created_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory withoutTrashed()
 *
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null                     $deleted_by
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ArticleCategory whereDeletedBy($value)
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @mixin \Eloquent
 */
class ArticleCategory extends BasePivot
{
    protected $fillable = ['category_id', 'article_id'];
}
