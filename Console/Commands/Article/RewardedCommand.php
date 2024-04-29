<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands\Article;

use Webmozart\Assert\Assert;
use Illuminate\Console\Command;
use Modules\Blog\Models\Article;

class RewardedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:article-rewarded {articleId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Selezionato un articolo scaduto, vengono effettuati le riscossioni delle scommesse';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        dddx('wip');
        $articleId = (string) $this->argument('articleId');
        Assert::notNull($article = Article::firstWhere(['id' => $articleId]));
        dddx($article->ratings);




        // $userId = (string) $this->argument('userId');
        // $articleId = (string) $this->argument('articleId');
        // $ratingId = (string) $this->argument('ratingId');
        // $credit = (int) $this->argument('credit');

        // $command = RatingArticleData::from([
        //     'userId' => $userId,
        //     'articleId' => $articleId,
        //     'ratingId' => $ratingId,
        //     'credit' => $credit,
        // ]);

        // try {
        //     ArticleAggregate::retrieve($command->articleId)
        //         ->rating($command);

        //     $this->newLine();
        //     $this->info("✓ Rating on article <fg=yellow>{$articleId}</> done");
        //     $this->newLine();
        // } catch (RatingClosedArticleError $error) {
        //     $this->newLine();
        //     $this->line("<bg=red;fg=black>✗ Rating not allowed:</> {$error->getMessage()}");
        //     $this->newLine();
        // } catch (\Exception $error) {
        //     $this->newLine();
        //     $this->line("<bg=red;fg=black>✗ Error:</> {$error->getMessage()}");
        //     $this->newLine();
        // }
    }
}
