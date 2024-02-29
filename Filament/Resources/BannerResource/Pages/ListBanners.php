<?php
/**
 * @see https://packagist.org/packages/owainjones74/filament-file-upload-chunked
 */

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\BannerResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\Blog\Filament\Resources\BannerResource;

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
                            ->acceptedFileTypes(['application/json', 'json'])
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
                        $json = json_decode($data['fileContent'], true);
                        dddx($json);
                    }),
        ];
    }
}
