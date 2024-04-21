<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Modules\Blog\Models\Article;

class TranslateContentAction
{
    public function execute(Article $article, array $locales): void
    {
        $article_content = $article->toArray()['content_blocks'];

        // per ora do per scontato che la traduzione italiana esista
        foreach ($locales as $locale) {
            if (! isset($article_content[$locale])) {
                $article_content[$locale] = $article_content['it'];
                // dddx([
                //     $locale,
                //     $article_content
                // ]);
            }
        }
        // dddx($article_content);
        $article->content_blocks = $article_content;
        $article->update();
        // dddx($article->toArray()['content_blocks']);
    }
}
