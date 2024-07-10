<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands\Profiles;

use Illuminate\Console\Command;
use Modules\Blog\Models\Profile;

class AddCreditsByProfilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:add-credits-profiles {profileId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiunge crediti al profilo';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // $users = User::all();

        // foreach ($users as $user) {
        //     Profile::firstOrCreate(
        //         ['user_id' => $user->id, 'email' => $user->email],
        //         ['credits' => 1000]
        //     );
        // }

        $this->newLine();
        $this->warn('⚡ wip');
        $this->newLine();
    }
}
