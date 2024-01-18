<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Aggregates\RatingAggregate;
use Modules\Blog\Datas\RatingData;
use Modules\Rating\Models\RatingMorph;

class RatingWinCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:rating-win {articleId} {ratingId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $userId = (string) $this->argument('userId');
        $articleId = (string) $this->argument('articleId');
        $ratingId = (string) $this->argument('ratingId');

        $rating_morphs = RatingMorph::where('rating_id', $ratingId)
            ->where('model_type', 'article')
            ->where('model_id', $articleId)
            ->where('value', '>', 0)
            ->get();

        // dddx($rating_morphs);

        foreach ($rating_morphs as $rm) {
            $command = RatingData::from([
                'userId' => $rm->user_id,
                // 'articleId' => $rm->article_id,
                'ratingId' => $rm->rating_id,
                'credit' => $rm->value,
            ]);

            dddx($command);

            try {
                RatingAggregate::retrieve($command->articleId)
                    ->addCredit($command);

                $this->newLine();
                $this->info("✓ Rating on article <fg=yellow>{$articleId}</> purchased");
                $this->newLine();
            } catch (\Exception $error) {
                $this->newLine();
                $this->line("<bg=red;fg=black>✗ Product out of stock:</> {$error->getMessage()}");
                $this->newLine();
            }
        }
    }
}
