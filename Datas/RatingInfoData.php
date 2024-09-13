<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Spatie\LaravelData\Data;

class RatingInfoData extends Data
{
    public string $ratingId;

    public string $title;

    public int $credit;

    public ?string $image = '#';

    public ?int $predict_victory = null;
}
