<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Modules\Blog\Models\Article;
use Filament\Forms\Components\Checkbox;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Rating\Filament\Actions\Table\BetAction;
use Modules\Blog\Actions\Article\TranslateContentAction;
use Modules\Rating\Filament\Actions\Header\BetHeaderAction;


class ViewArticle extends ViewRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
            BetHeaderAction::make(),
            /*
            Actions\Action::make('translate')
                ->label('Copia Blocchi nelle altre lingue')
                ->tooltip('translate')
                ->icon('heroicon-o-language')
                ->requiresConfirmation()
                ->modalDescription('Assicurati che la versione italiana sia stata settata e salvata')
                ->form([
                    Checkbox::make('content_blocks')->inline(),
                    Checkbox::make('sidebar_blocks')->inline(),
                    Checkbox::make('footer_blocks')->inline(),
                ])
                ->action(function (Article $record, ArticleResource $article_resource, array $data) {
                    return app(TranslateContentAction::class)->execute(
                        'article',
                        $record->id, $article_resource->getTranslatableLocales(),
                        $data,
                        Article::class
                    );
                }),
            */
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // ...
                TextEntry::make('title')
            ]);
    }
}
