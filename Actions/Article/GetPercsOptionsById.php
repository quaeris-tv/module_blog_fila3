<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Modules\Blog\Models\Article;
use Webmozart\Assert\Assert;

class GetPercsOptionsById
{
    public function execute(array $article_array): array
    {
        $result = [];
        Assert::notNull($article = Article::find($article_array['id']),'['.__LINE__.']['.__FILE__.']');
        Assert::isInstanceOf($article, Article::class);
        $total_volume = $article->getVolumeCredit();

        foreach ($article_array['ratings'] as $rating) {
            $result[$rating['id']] = 0;
            if (0 != $total_volume) {
                $perc = $article->getVolumeCredit($rating['id']) / $total_volume;
                if (0 != $perc) {
                    // $result[$rating['id']] = round(1 / $perc, 2);
                    $result[$rating['id']] = 1 / $perc;
                }
            }
        }

        return $result;

        // dddx($result);

        // dddx([
        //     $article,
        //     $article->getVolumeCredit(),
        //     $article->getVolumeCredit(171),
        //     $article->getVolumeCredit(170),
        // ]);
    }
}
