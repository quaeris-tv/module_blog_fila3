<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Models\Profile;
use Webmozart\Assert\Assert;

class ProfileRatingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:profile-ratings {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Visualizza votazioni dell utente';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $userId = (string) $this->argument('userId');

        Assert::notNull($profile = Profile::firstWhere(['user_id' => $userId]));

        $rows = $profile->ratings()
            ->select('value', 'user_id', 'title as answer', 'model_id', 'model_type')
            ->get()
            ->map(function ($item) {
                // dddx($item->toArray());
                $data = $item->toArray();
                // $data['question'] = $item->linkedTo->title;
                $data['question'] = $item->answer;

                return $data;
            })
            ->toArray();

        if (count($rows) > 0) {
            Assert::isArray($rows[0]);
            $headers = array_keys($rows[0]);

            $this->newLine();
            $this->table($headers, $rows);
            $this->newLine();
        } else {
            $this->newLine();
            $this->warn('⚡ No records');
            $this->newLine();
        }
    }
}
