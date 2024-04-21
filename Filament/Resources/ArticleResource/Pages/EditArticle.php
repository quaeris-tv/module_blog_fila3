<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Modules\Blog\Models\Article;
use Filament\Resources\Pages\EditRecord;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Blog\Actions\Article\TranslateContentAction;

class EditArticle extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('translate')
                ->label('translate')
                ->tooltip('translate')
                ->icon('heroicon-o-language')
                ->requiresConfirmation()
                ->modalDescription('Assicurati che la versione italiana sia stata salvata')
                ->action(static fn (Article $record, ArticleResource $article_resource) => app(TranslateContentAction::class)->execute($record, $article_resource->getTranslatableLocales())),
        ];
    }
}
