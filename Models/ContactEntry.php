<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * Modules\Blog\Models\ContactEntry.
 *
 * @method static \Modules\Blog\Database\Factories\ContactEntryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEntry   newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEntry   newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEntry   onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEntry   query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEntry   withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactEntry   withoutTrashed()
 *
 * @property \Modules\Xot\Contracts\ProfileContract|null $creator
 * @property \Modules\Xot\Contracts\ProfileContract|null $updater
 *
 * @mixin \Eloquent
 */
class ContactEntry extends BaseModel
{
    protected $fillable = [''];
}
