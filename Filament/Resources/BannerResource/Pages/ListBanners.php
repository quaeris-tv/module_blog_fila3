<?php
/**
 * @see https://packagist.org/packages/owainjones74/filament-file-upload-chunked
 */

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

use Filament\Actions;
use Webmozart\Assert\Assert;
use function Safe\json_decode;
use Modules\Blog\Models\Banner;
use Illuminate\Support\Facades\File;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Filament\Resources\BannerResource;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ListBanners extends ListRecords
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('import')
                    ->form([
                        FileUpload::make('file')
                            ->label('')
                            // ->acceptedFileTypes(['application/json', 'json'])
                            ->imagePreviewHeight('250')
                            ->reactive()
                            ->afterStateUpdated(static function (callable $set, TemporaryUploadedFile $state) {
                                $set('fileContent', File::get($state->getRealPath()));
                            }),
                        Textarea::make('fileContent'),
                    ])
                    ->label('')
                    ->tooltip('Import')
                    ->icon('heroicon-o-folder-open')
                    ->action(static function ($data) {
                        Assert::isArray($json = json_decode($data['fileContent'], true));
                        // dddx($json);
                        foreach($json as $j){
                            // dddx($j);
                            Banner::firstOrCreate([
                                'title' => $j['title'],
                                'description' => $j['short_description'],
                                'action_text' => $j['action_text'],
                                'link' => $j['link'],
                                // 'start_date' => $j['start_date'],
                                // 'end_date' => $j['end_date'],
                                // 'hot_topic' => $j['hot_topic']
                            ]);
                        }
                    }),
        ];
    }
}


// "photo11":{
//     "id": 1,
//     "desktop_thumbnail":
//       "https://futuur-media-production.s3.amazonaws.com/cache/69/96/699635b11663281902877af264b1f181.jpg",
//     "mobile_thumbnail":
//       "https://futuur-media-production.s3.amazonaws.com/cache/cf/d2/cfd2f40883ddc7bab784f1b4162d975e.jpg",
//     "desktop_thumbnail_webp":
//       "https://futuur-media-production.s3.amazonaws.com/cache/1c/a1/1ca118c81f4728ab80396eb457330671.webp",
//     "mobile_thumbnail_webp":
//       "https://futuur-media-production.s3.amazonaws.com/cache/45/95/459548c28cc7fe4c056af42a85ffc93e.webp",
//     "link": "https://futuur.com/q/suggest",
//     "title": "Suggest a Market! 🔮",
//     "short_description":
//       "What do you want to know?\r\nPut the crowd to work for you",
//     "action_text": "Make a Suggestion",
//     "category": null,
//     "category_dict": null,
//     "end_date": null,
//     "hot_topic": false,
//     "open_markets_count": null,
//     "landing_banner": false
//   }
