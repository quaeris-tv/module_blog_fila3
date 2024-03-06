<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Category;

use Webmozart\Assert\Assert;
use Modules\Blog\Models\Category;
use Illuminate\Support\Collection;
use Spatie\QueueableAction\QueueableAction;

class GetBloodline
{
    use QueueableAction;

    public function execute(int $category_id): Collection
    {
        Assert::notNull($category = Category::find($category_id));

        return $category->bloodline()->get()->reverse();
    }
}
