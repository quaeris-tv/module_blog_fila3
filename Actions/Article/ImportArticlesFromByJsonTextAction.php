<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class ImportArticlesFromByJsonTextAction
{
    use QueueableAction;

    public function execute(string $json_text): void
    {
        Assert::isArray($json = json_decode($json_text, true));

        foreach ($json as $j) {
            $article_where = [
                'title' => $j['title'],
                'slug' => $j['slug'],
            ];

            $article_data = [
                'title' => $j['title'],
                'slug' => $j['slug'],
            ];
        }
    }
}
