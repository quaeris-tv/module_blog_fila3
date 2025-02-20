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
        // Recupera il modello corrispondente all'ID
        $model = app(GetModelByModelTypeAction::class)->execute($model_class, $article_id);
        Assert::isInstanceOf($model, app($class), '['.__LINE__.']['.__FILE__.']');

        // Converti il modello in array e verifica che sia valido
        Assert::isArray($model_contents = $model->toArray(), '['.__LINE__.']['.__FILE__.']');

        // Gestione content_blocks
        if (!empty($data['content_blocks'])) {
            $model->content_blocks = $this->translateBlocks(
                $model_contents['content_blocks'] ?? null,
                $locales
            );
        }

        // Gestione sidebar_blocks
        if (!empty($data['sidebar_blocks'])) {
            $model->sidebar_blocks = $this->translateBlocks(
                $model_contents['sidebar_blocks'] ?? null,
                $locales
            );
        }

        // Gestione footer_blocks
        if (!empty($data['footer_blocks'])) {
            $model->footer_blocks = $this->translateBlocks(
                $model_contents['footer_blocks'] ?? null,
                $locales
            );
        }

        // Aggiorna il modello con le nuove traduzioni
        $model->update();
    }

    /**
     * Metodo per tradurre i blocchi di contenuto.
     */
    private function translateBlocks(?array $model_content, array $locales): array
    {
        // Se il contenuto è null, inizializza come array vuoto
        $model_content = $model_content ?? [];

        // Verifica che esista una traduzione italiana, altrimenti imposta un array vuoto
        if (!isset($model_content['it']) || !is_array($model_content['it'])) {
            $model_content['it'] = [];
        }

        // Copia un array vuoto nelle altre lingue mancanti
        foreach ($locales as $locale) {
            if (!isset($model_content[$locale]) || !is_array($model_content[$locale])) {
                $model_content[$locale] = [];
            }
        }

        return $model_content;
    }
}
