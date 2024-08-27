<?php

declare(strict_types=1);

namespace Modules\Blog\Listeners;

use Illuminate\Auth\Events\Registered;
use Modules\Blog\Models\Profile;
use Modules\Xot\Datas\XotData;
use Webmozart\Assert\Assert;

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
        $user_class = XotData::make()->getUserClass();
        Assert::notNull($user = $event->user, '['.__LINE__.']['.__FILE__.']');
<<<<<<< HEAD
        Assert::isInstanceOf($user, XotData::make()->getUserClass(), '['.__LINE__.']['.__FILE__.']');
=======
        Assert::isInstanceOf($user, $user_class, '['.__LINE__.']['.__FILE__.']');
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b

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
