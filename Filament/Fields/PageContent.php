<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Fields;

use FilamentTiptapEditor\TiptapEditor;

class PageContent
{
    public static function make(
        string $name,
        string $context = 'form',
    ): TiptapEditor {
        return TiptapEditor::make($name)->columnSpanFull();
    }
}
