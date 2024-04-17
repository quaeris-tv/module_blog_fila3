<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Category;

use Illuminate\Support\Collection;
use Modules\Blog\Models\Category;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class GetBloodline
{
    use QueueableAction;

<<<<<<< HEAD
    public function execute(int $category_id): Collection
    {
=======
    public function execute(?int $category_id): Collection
    {
        if (null == $category_id) {
            return collect([]);
        }
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
        Assert::notNull($category = Category::find($category_id));

        return $category->bloodline()->get()->reverse();
    }
}
