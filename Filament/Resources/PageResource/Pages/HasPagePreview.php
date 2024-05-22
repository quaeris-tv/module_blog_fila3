<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PageResource\Pages;

use Filament\Forms\Components\Component;
use Modules\Blog\Filament\Fields\PageContent;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasBuilderPreview;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

trait HasPagePreview
{
    use HasBuilderPreview;
    use HasPreviewModal;

    protected function getActions(): array
    {
        return [
            PreviewAction::make()->label('Preview Changes'),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'page.show';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'page';
    }

    protected function getBuilderPreviewView(string $builderName): ?string
    {
        return 'page.preview-content';
    }

    public static function getBuilderEditorSchema(string $builderName): Component|array
    {
        return [
            PageContent::make(
                name: 'content',
                context: 'preview',
            ),
        ];
    }
}
