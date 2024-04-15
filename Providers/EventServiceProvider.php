<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Modules\User\Listeners\LoginListener;
use Modules\User\Listeners\LogoutListener;
use SocialiteProviders\Auth0\Auth0ExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        Registered::class => [
            ProfileRegisteredListener::class,
        ],

        // SocialiteWasCalled::class => [
        //     Auth0ExtendSocialite::class.'@handle',
        // ],
        // Login::class => [
        //     LoginListener::class,
        // ],
        // Logout::class => [
        //     LogoutListener::class,
        // ],
    ];
}
