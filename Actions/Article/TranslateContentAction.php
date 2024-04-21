<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Modules\Xot\Actions\GetModelByModelTypeAction;

class TranslateContentAction
{
    public function execute(string $model_class, string $article_id, array $locales): void
    {
        $model = app(GetModelByModelTypeAction::class)->execute($model_class, $article_id);

        $model_content = $model->toArray()['content_blocks'];

        // per ora do per scontato che la traduzione italiana esista
        foreach ($locales as $locale) {
            if (! isset($model_content[$locale])) {
                $model_content[$locale] = $model_content['it'];
            }
        }
        $model->content_blocks = $model_content;
        $model->update();
    }
}
