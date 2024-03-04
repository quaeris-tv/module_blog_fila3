<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Modules\Blog\Models\Article;
use Spatie\LaravelData\Data;

class ArticleData extends Data
{
    public function __construct(
        public string $title,
        public string $slug,
        public int $category_id,
        public ?string $status,
        public bool $show_on_homepage,
        public string $published_at,
        public ?array $content_blocks,
        public ?array $sidebar_blocks,
        public ?array $footer_blocks,
        // public string $class,
        // public string $articleId;
        // public string $ratingId;
        // public int $credit;
    ) {
        $this->class = Article::class;
    }
}
