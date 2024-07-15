<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands\Profiles;

use Illuminate\Console\Command;
use Modules\Blog\Aggregates\ProfileAggregate;
use Modules\Blog\Datas\AddedCreditsData;
use Modules\Blog\Models\Profile;
use Webmozart\Assert\Assert;

class AddCreditsByProfilesEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:add-credits-profiles {email} {credit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiunge crediti al profilo indicato tramite email';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = (string) $this->argument('email');
        Assert::notNull($profile = Profile::where('email', $email)->first());
        $credit = (int) $this->argument('credit');

        $command = AddedCreditsData::from([
            'profileId' => (string) $profile->id,
            'userId' => $profile->user_id,
            'credit' => $credit,
        ]);

        try {
            ProfileAggregate::retrieve($command->userId)
                ->creditAdded($command);

            $this->newLine();
            $this->info("✓ Credit added to profile id <fg=yellow>{$profile->id}</>");
            $this->newLine();
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
