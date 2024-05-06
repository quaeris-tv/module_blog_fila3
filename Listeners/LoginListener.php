<?php

declare(strict_types=1);

namespace Modules\Blog\Listeners;

use Illuminate\Auth\Events\Login;
use Modules\Blog\Models\Profile;
use Modules\User\Models\User;
use Webmozart\Assert\Assert;

class LoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        Assert::notNull($user = $event->user);
        Assert::isInstanceOf($user, User::class);


        // .....
        // $user->profile()->create([
        //     'email' => $user->email,
        //     'credits' => 1000,
        // ]);

        // Profile::firstOrCreate(
        //     [
        //     'user_id' => $event->user->id,
        //     'email' => $event->user->email,
        //     'credits' => 1000
        //     ],
        // );
    }
}
