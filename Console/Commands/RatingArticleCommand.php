<?php

<<<<<<< HEAD
<<<<<<< HEAD
declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Aggregates\ArticleAggregate;
use Modules\Blog\Datas\RatingArticleData;
=======
=======
declare(strict_types=1);

>>>>>>> 934879b (Lint)
namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Aggregates\ArticleAggregate;
<<<<<<< HEAD
>>>>>>> e600cc0 (.)
=======
use Modules\Blog\Datas\RatingArticleData;
>>>>>>> 934879b (Lint)

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
<<<<<<< HEAD
    protected $description = 'Un utente scommette su un articolo';
=======
    protected $description = 'Command description';
>>>>>>> e600cc0 (.)

    /**
     * Execute the console command.
     */
    public function handle()
    {
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 934879b (Lint)
        $userId = (string) $this->argument('userId');
        $articleId = (string) $this->argument('articleId');
        $ratingId = (string) $this->argument('ratingId');
        $credit = (int) $this->argument('credit');
<<<<<<< HEAD

        $command = RatingArticleData::from([
            'userId' => $userId,
            'articleId' => $articleId,
            'ratingId' => $ratingId,
            'credit' => $credit,
=======
        $userId = (string)$this->argument('userId');
        $articleId = (string)$this->argument('articleId');
        $ratingId = (string)$this->argument('ratingId');
        $credit = (int)$this->argument('credit');

        $command = RatingArticleData::from([
            'userId'=>$userId,
            'articleId'=>$articleId,
            'ratingId'=>$ratingId,
            'credit'=>$credit
>>>>>>> e600cc0 (.)
=======

        $command = RatingArticleData::from([
            'userId' => $userId,
            'articleId' => $articleId,
            'ratingId' => $ratingId,
            'credit' => $credit,
>>>>>>> 934879b (Lint)
        ]);

        try {
            ArticleAggregate::retrieve($command->articleId)
                ->rating($command);

            $this->newLine();
<<<<<<< HEAD
            $this->info("✓ Rating on article <fg=yellow>{$articleId}</> purchased");
            $this->newLine();
=======
            $this->info("✓ Product <fg=yellow>{$articleId}</> purchased");
            $this->newLine();
<<<<<<< HEAD

>>>>>>> e600cc0 (.)
=======
>>>>>>> 934879b (Lint)
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Product out of stock:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
