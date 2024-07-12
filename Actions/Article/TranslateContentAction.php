<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Modules\Blog\Models\Article;
use Modules\Xot\Actions\GetModelByModelTypeAction;
use Modules\Xot\Actions\GetModelClassByModelTypeAction;
use Webmozart\Assert\Assert;

class TranslateContentAction
{
    public function execute(string $model_class, string $article_id, array $locales, array $data, string $class): void
    {
        // dddx([app(GetModelClassByModelTypeAction::class)->execute($model_class), Article::class]);
        // dddx(app($class));
        Assert::isInstanceOf($model = app(GetModelByModelTypeAction::class)->execute($model_class, $article_id), app($class), '['.__LINE__.']['.__FILE__.']');

        Assert::isArray($model_contents = $model->toArray(), '['.__LINE__.']['.__FILE__.']');

        if ($data['content_blocks']) {
            $model_content = $model_contents['content_blocks'];

            // per ora do per scontato che la traduzione italiana esista
            foreach ($locales as $locale) {
                if (! isset($model_content[$locale])) {
                    $model_content[$locale] = $model_content['it'];
                }
            }
            // @phpstan-ignore-next-line
            $model->content_blocks = $model_content;
        }

        if ($data['sidebar_blocks']) {
            $model_content = $model_contents['sidebar_blocks'];

            // per ora do per scontato che la traduzione italiana esista
            foreach ($locales as $locale) {
                if (! isset($model_content[$locale])) {
                    $model_content[$locale] = $model_content['it'];
                }
            }
            // @phpstan-ignore-next-line
            $model->sidebar_blocks = $model_content;
        }

        if ($data['footer_blocks']) {
            $model_content = $model_contents['footer_blocks'];

            // per ora do per scontato che la traduzione italiana esista
            foreach ($locales as $locale) {
                if (! isset($model_content[$locale])) {
                    $model_content[$locale] = $model_content['it'];
                }
            }
            // @phpstan-ignore-next-line
            $model->footer_blocks = $model_content;
        }

        $model->update();
    }
}
