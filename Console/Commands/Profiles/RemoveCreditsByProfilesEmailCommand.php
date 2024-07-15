<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands\Profiles;

use Webmozart\Assert\Assert;
use Illuminate\Console\Command;
use Modules\Blog\Models\Profile;
use Modules\Blog\Datas\RemovedCreditsData;
use Modules\Blog\Aggregates\ProfileAggregate;

class RemoveCreditsByProfilesEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:remove-credits-profiles {email} {credit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rimuove crediti al profilo indicato tramite email';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = (string) $this->argument('email');
        Assert::notNull($profile = Profile::where('email', $email)->first());
        $credit = (int) $this->argument('credit');

        $command = RemovedCreditsData::from([
            'profileId' => (string) $profile->id,
            'userId' => $profile->user_id,
            'credit' => $credit,
        ]);

        try {
            ProfileAggregate::retrieve($command->userId)
                ->creditRemoved($command);

            $this->newLine();
            $this->info("✓ Credit removed to profile id <fg=yellow>{$profile->id}</>");
            $this->newLine();
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
