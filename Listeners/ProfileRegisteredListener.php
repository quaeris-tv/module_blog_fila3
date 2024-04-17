<?php

declare(strict_types=1);

namespace Modules\Blog\Listeners;

use Webmozart\Assert\Assert;
use Modules\User\Models\User;
use Modules\Blog\Models\Profile;
use Illuminate\Auth\Events\Registered;

class ProfileRegisteredListener
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
    public function handle(Registered $event): void
    {
        Assert::notNull($user = $event->user);
        Assert::isInstanceOf($user, User::class);

        $user->profile()->create([
            'email' => $user->email,
            'credits' => 1000,
        ]);

        // Profile::firstOrCreate(
        //     [
        //     'user_id' => $event->user->id,
        //     'email' => $event->user->email,
        //     'credits' => 1000
        //     ],
        // );
    }
}
