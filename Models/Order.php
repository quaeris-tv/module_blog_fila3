<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * @property date   $date
 * @property string $articleId
 * @property int    $bet_credits
 */
class Order extends BaseModel
{
    protected $fillable = ['date', 'articleId', 'bet_credits'];
}
