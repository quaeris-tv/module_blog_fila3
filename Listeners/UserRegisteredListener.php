<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Models\Profile;
use Modules\User\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        dddx('a');
        Profile::firstOrCreate([
            ['user_id' => $event->user->id],
            ['email' => $event->user->email],
        ]);
    }
}
