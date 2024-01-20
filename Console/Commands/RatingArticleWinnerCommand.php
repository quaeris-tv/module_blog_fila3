<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Aggregates\ArticleAggregate;
use Modules\Blog\Datas\RatingArticleWinnerData;
use Modules\Blog\Datas\RatingData;
use Modules\Rating\Models\RatingMorph;

class RatingArticleWinnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:rating-article-winnner {articleId} {ratingId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Un articolo viene chiuso alle scommesse selezionando la risposta vincente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $articleId = (string) $this->argument('articleId');
        $ratingId = (string) $this->argument('ratingId');

        $command = RatingArticleWinnerData::from([
            'ratingId' => $ratingId,
            'articleId' => $articleId,
        ]);

        try {
            ArticleAggregate::retrieve($command->ratingId)
                ->winner($command);

            $this->newLine();
            $this->info("✓ Rating <fg=yellow>{$ratingId}</> on article <fg=yellow>{$articleId}</> set winning");
            $this->newLine();
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
