<?php

declare(strict_types=1);

namespace Modules\Blog\Providers\Filament;

use Filament\Panel;
use Pboivin\FilamentPeek\FilamentPeekPlugin;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;

class AdminPanelProvider extends XotBasePanelProvider
{
    protected string $module = 'Blog';

    // public function panel(Panel $panel): Panel
    // {
    //     return parent::panel($panel)->plugins([
    //         FilamentPeekPlugin::make()
    //     ]);
    // }
}
