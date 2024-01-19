<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Blog\Events\BetArticle;
use Modules\Blog\Models\Profile;
=======
use Modules\Blog\Models\Profile;
use Modules\Blog\Events\BetArticle;
>>>>>>> 0f9a9ba (test)
=======
use Modules\Blog\Events\BetArticle;
use Modules\Blog\Models\Profile;
>>>>>>> bba6ab7 (Lint)
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class BetBalanceProjector extends Projector
{
    public function onBetArticle(BetArticle $event)
    {
        (new Profile($event->betAttributes))->writeable()->save();
    }

    // public function onAccountCreated(AccountCreated $event)
    // {
    //     (new Account($event->accountAttributes))->writeable()->save();
    // }

    // public function onMoneyAdded(MoneyAdded $event)
    // {
    //     $account = Account::uuid($event->accountUuid);

    //     $account->balance += $event->amount;

    //     $account->writeable()->save();
    // }

    // public function onMoneySubtracted(MoneySubtracted $event)
    // {
    //     $account = Account::uuid($event->accountUuid);

    //     $account->balance -= $event->amount;

    //     $account->writeable()->save();
    // }

    // public function onAccountDeleted(AccountDeleted $event)
    // {
    //     Account::uuid($event->accountUuid)->writeable()->delete();
    // }
<<<<<<< HEAD
<<<<<<< HEAD
}
=======
}
>>>>>>> 0f9a9ba (test)
=======
}
>>>>>>> bba6ab7 (Lint)
