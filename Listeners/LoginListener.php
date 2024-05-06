<?php

declare(strict_types=1);

namespace Modules\Blog\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Modules\Blog\Models\Profile;
use Modules\Blog\Models\Transaction;
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

        $welcome_login = Transaction::where('user_id', $user->id)
                ->where('note', 'welcome')
                ->first();

        if (null == $welcome_login) {
            $user->profile()->firstOrcreate([
                'email' => $user->email,
                'credits' => 1000,
            ]);


            Transaction::create([
                'model_type' => 'profile',
                'model_id' => $user->profile->id,
                'user_id' => $user->id,
                'date' => Carbon::now(),
                'credits' => 1000,
                'note' => 'welcome',
            ]);
        }

        // $user->profile()->firstOrcreate([
        //     'email' => $user->email,
        //     'credits' => 1000,
        // ]);
    }
}
