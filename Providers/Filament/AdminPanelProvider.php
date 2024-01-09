<?php

declare(strict_types=1);

namespace Modules\Blog\Providers\Filament;

use Filament\Panel;
use Modules\Xot\Providers\Filament\XotBasePanelProvider;
use Pboivin\FilamentPeek\FilamentPeekPlugin;

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
