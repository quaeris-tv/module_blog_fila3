<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetModelByModelTypeAction;
use Modules\Xot\Actions\GetModelClassByModelTypeAction;
use Webmozart\Assert\Assert;

class RewardArticleAction
{
    public function execute(Article $article): void
    {
        if(now()<$article->closed_at){
            return ;
        }
        if($article->rewarded_at !== null){
            return ;
        }

        dddx('a');
    }
}