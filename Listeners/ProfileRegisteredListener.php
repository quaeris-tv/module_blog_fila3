<?php

declare(strict_types=1);

namespace Modules\Blog\Listeners;

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
        $event->user->profile()->create([
            'email' => $event->user->email,
            'credits' => 1000
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
