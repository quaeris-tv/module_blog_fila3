<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands\Profiles;

use Modules\User\Models\User;
use Illuminate\Console\Command;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;

class CreateProfileByUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:create-profiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea i profili dalla lista di utenti';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach($users as $user){
            Profile::firstOrCreate(
                ['user_id' => $user->id],
                ['email' => $user->email],
                ['credits' => 1000]
            );
        }

        $this->newLine();
        $this->warn('⚡ Done');
        $this->newLine();
    }
}
