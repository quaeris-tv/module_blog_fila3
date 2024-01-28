<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

/**
 * @property date   $date
 * @property string $article_id
 * @property string $rating_id
 * @property int    $bet_credits
 */
class Order extends BaseModel
{
    protected $fillable = ['date', 'article_id', 'rating_id', 'bet_credits'];
}
