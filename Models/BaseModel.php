<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\Factory;
// ---------- traits
// //use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Xot\Actions\Factory\GetFactoryAction;
use Modules\Xot\Traits\Updater;

/**
 * Class BaseModel.
 */
abstract class BaseModel extends Model
{
    use HasFactory;

    // use Searchable;
    // use Cachable;
    use SoftDeletes;
    use Updater;

    /**
     * Indicates whether attributes are snake cased on arrays.
     *
     * @see  https://laravel-news.com/6-eloquent-secrets
     *
     * @var bool
     */
    public static $snakeAttributes = true;

    /** @var int */
    protected $perPage = 30;

    /** @var string */
    protected $connection = 'blog';

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime', 'created_at' => 'datetime', 'updated_at' => 'datetime',
        ];
    }

    /** @var string */
    protected $primaryKey = 'id';

    /** @var bool */
    public $incrementing = true;

    /** @var array<int, string> */
    protected $hidden = [
        // 'password'
    ];

    /** @var bool */
    public $timestamps = true;

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory
     */
    protected static function newFactory()
    {
        return app(GetFactoryAction::class)->execute(static::class);
    }
}
