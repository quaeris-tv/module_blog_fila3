<?php

<<<<<<< HEAD
declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Aggregates\ArticleAggregate;
use Modules\Blog\Datas\RatingArticleData;
=======
namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use App\Command\PurchaseProduct;
use App\Aggregates\ProductAggregate;
use App\Error\ProductOutOfStockError;
use App\Error\ProductNotRegisteredError;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Aggregates\ArticleAggregate;
>>>>>>> e600cc0 (.)

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
        $userId = (string) $this->argument('userId');
        $articleId = (string) $this->argument('articleId');
        $ratingId = (string) $this->argument('ratingId');
        $credit = (int) $this->argument('credit');

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

>>>>>>> e600cc0 (.)
        } catch (\Exception $error) {
            $this->newLine();
            $this->line("<bg=red;fg=black>✗ Product out of stock:</> {$error->getMessage()}");
            $this->newLine();
        }
    }
}
