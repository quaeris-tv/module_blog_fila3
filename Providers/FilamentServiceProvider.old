<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Savannabits\FilamentModules\ContextServiceProvider;

class FilamentServiceProvider extends ContextServiceProvider
{
    public static string $name = 'blog-filament';
    public static string $module = 'Blog';

    public function packageRegistered(): void
    {
        $this->app->booting(function () {
            $this->registerConfigs();
        });
        parent::packageRegistered();
    }
    /* -- WIP
    public function packageBooted(): void
    {
        parent::packageBooted();
        $this->registerLocale();
    }

    public function registerLocale(): void
    {
        $locale = session()->get('locale') ?? request()->get('locale') ?? request()->cookie('filament_language_switch_locale') ?? config('app.locale', 'en');
        app()->setLocale('en');
    }
    */

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            app('modules')->findOrFail(static::$module)->getExtraPath('Config/'.static::$name.'.php'),
            static::$name
        );
    }

    public function boot()
    {
        parent::boot();
        Filament::serving(function () {
            Filament::forContext('filament', function () {
                Filament::registerNavigationItems([
                    NavigationItem::make(static::$module)->label(static::$module.' ')->url(route(static::$name.'.pages.dashboard'))->icon('heroicon-o-bookmark')->group('Modules'),
                ]);
            });
            Filament::forContext(static::$name, function () {
                Filament::registerRenderHook('sidebar.start', fn (): string => \Blade::render('<div class="p-2 px-6 bg-primary-100 font-black w-full">'.static::$module.' </div>'));
            });
        });
    }
}
