<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

<<<<<<< HEAD
use Illuminate\Routing\Router;
use Modules\Blog\Console\Commands\RatingArticleCommand;
use Modules\Blog\Console\Commands\RatingWinCommand;
use Modules\Blog\Console\Commands\ShowArticleListCommand;
use Modules\Blog\Projectors\ArticleProjector;
use Modules\Blog\Projectors\BetBalanceProjector;
use Modules\Xot\Datas\XotData;
use Spatie\EventSourcing\Facades\Projectionist;
use Modules\Blog\Projectors\BetBalanceProjector;
use Modules\Xot\Providers\XotBaseServiceProvider;
<<<<<<< HEAD
use Spatie\EventSourcing\Facades\Projectionist;
=======
use BezhanSalleh\FilamentLanguageSwitch\Http\Middleware\SwitchLanguageLocale;
>>>>>>> 0f9a9ba (test)
=======
use BezhanSalleh\FilamentLanguageSwitch\Http\Middleware\SwitchLanguageLocale;
use Illuminate\Routing\Router;
use Modules\Blog\Projectors\BetBalanceProjector;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Providers\XotBaseServiceProvider;
use Spatie\EventSourcing\Facades\Projectionist;
>>>>>>> bba6ab7 (Lint)

class BlogServiceProvider extends XotBaseServiceProvider
{
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'blog';

    public function bootCallback(): void
    {
        // $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
        // $kernel->pushMiddleware(SwitchLanguageLocale::class);
        $router = app('router');
        $this->registerMyMiddleware($router);
        $this->registerRoutes($router);

<<<<<<< HEAD
        $this->registerCommands();

        Projectionist::addProjectors([
            BetBalanceProjector::class,
            ArticleProjector::class,
            // YetAnotherProjector::class,
        ]);
    }

    public function registerCommands(): void
    {
        $this->commands([
            RatingArticleCommand::class,
            RatingWinCommand::class,
            ShowArticleListCommand::class,
        ]);
=======
        Projectionist::addProjectors([
            BetBalanceProjector::class,
            // YetAnotherProjector::class,
        ]);
>>>>>>> 0f9a9ba (test)
    }

    public function registerRoutes(Router $router): void
    {
        /*$this->app['router']->group(['prefix' => \Config::get('my-package::prefix')], function ($router) {
         $router->get('my-route', 'MyVendor\MyPackage\MyController@action');
         $router->get('my-second-route', 'MyVendor\MyPackage\MyController@otherAction');
        });
        */
        $xot = XotData::make();
        // dddx($xot->main_module);
        // $xot->update(['main_module'=>'Blog']);
        // $router->get('/', $xot->getHomeController());
    }

    public function registerCallback(): void
    {
    }

    public function registerMyMiddleware(Router $router): void
    {
        // $router->pushMiddlewareToGroup('web', SetDefaultLocaleForUrlsMiddleware::class);
        // $router->pushMiddlewareToGroup('web', SwitchLanguageLocale::class);
        // $router->appendMiddlewareToGroup('api', SwitchLanguageLocale::class);
        // dddx(app()->getLocale());
    }
}
