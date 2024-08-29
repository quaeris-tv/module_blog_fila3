<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Spatie\LaravelData\Data;

class RemovedCreditsData extends Data
{
    // public string $adminId;
    public string $profileId;

    public string $userId;

    public int $credit;
}
