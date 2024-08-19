<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Spatie\LaravelData\Data;

class RatingArticleData extends Data
{
    public string $userId;

    public string $articleId;

    public string $ratingId;

    public int $credit;
}
