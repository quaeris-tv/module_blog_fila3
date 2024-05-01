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
use Filament\Forms\Components\DateTimePicker;
use Modules\Blog\Filament\Resources\ArticleResource;
use Modules\Blog\Actions\Article\TranslateContentAction;
use Modules\Rating\Filament\Actions\Header\BetHeaderAction;
use Modules\Rating\Filament\Actions\Header\WinHeaderAction;
use Modules\Blog\Filament\Resources\ArticleResource\Widgets;
use Modules\Rating\Filament\Resources\HasRatingResource\Widgets as RatingWidgets;

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
            WinHeaderAction::make(),
            Actions\Action::make('change_closed_at')
                ->tooltip('cambia data chiusura')
                ->label('')
                ->icon('heroicon-o-lock-closed')
                ->form([
                    DateTimePicker::make('closed_at')
                        ->native(false),
                ])
                ->action(function (array $data, $record): void {
                    $record->update($data);
                }),
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

    protected function getHeaderWidgets(): array
    {
        return [
            RatingWidgets\StatsOverview::class,
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // ...
                TextEntry::make('title'),
                TextEntry::make('closed_at'),
                TextEntry::make('rewarded_at'),
            ]);
    }
}
