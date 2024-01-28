<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Spatie\LaravelData\Data;

class StatsRatingArticleData extends Data
{
    // public string $articleId;
    // public int $bet_credits;
    // public string $date;

    public function __construct(
        public string $articleId,
        public int $bet_credits,
        public string $date,
    ) {
    }
}
