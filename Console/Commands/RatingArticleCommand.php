<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Aggregates\ArticleAggregate;
use Modules\Blog\Datas\RatingArticleData;

class RatingArticleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:rating-article {userId} {articleId} {ratingId} {credit}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Un utente scommette su un articolo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = (string) $this->argument('userId');
        $articleId = (string) $this->argument('articleId');
        $ratingId = (string) $this->argument('ratingId');
        $credit = (int) $this->argument('credit');

        $command = RatingArticleData::from([
            'userId' => $userId,
            'articleId' => $articleId,
            'ratingId' => $ratingId,
            'credit' => $credit,
        ]);

        try {
            ArticleAggregate::retrieve($command->articleId)
                ->rating($command);

            $this->newLine();
            $this->info("✓ Rating on article <fg=yellow>{$articleId}</> done");
            $this->newLine();
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
