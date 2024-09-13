<?php

declare(strict_types=1);

namespace Modules\Blog\Console\Commands;

use Illuminate\Console\Command;
use Modules\Blog\Models\Article;
use Webmozart\Assert\Assert;

class ShowArticleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:article-show {articleId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Visualizza articolo';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $articleId = (string) $this->argument('articleId');
        Assert::notNull($article = Article::firstWhere(['id' => $articleId]), '['.__LINE__.']['.__FILE__.']');

        $ratings = $article->ratings()
            ->where('user_id', null)

            ->get();

        $this->info($article->title);
        $header = ['id', 'title', 'is_winner', 'count', 'sum', 'avg', 'tot'];
        $rows = [];
        foreach ($ratings as $rating) {
            $tmp = $article->loadSum(['ratings as value_sum' => static function ($query) use ($rating): void {
                $query
                    ->where('ratings.id', $rating->id)
                    ->where('rating_morph.user_id', '!=', null);
            }], 'rating_morph.value')
                ->loadSum(['ratings as value_tot' => static function ($query) use ($ratings): void {
                    $query
                        ->whereIn('ratings.id', $ratings->modelKeys())
                        ->where('rating_morph.user_id', '!=', null);
                }], 'rating_morph.value')
            /*
            ->loadAvg(['ratings as value_avg' => static function ($query) use ($rating) {
                $query
                    ->where('ratings.id', $rating->id)
                    ->where('rating_morph.user_id', '!=', null);
            }], 'rating_morph.value')
            */
                ->loadCount(['ratings as value_count' => static function ($query) use ($rating): void {
                    $query
                        ->where('ratings.id', $rating->id)
                        ->where('rating_morph.user_id', '!=', null);
                }], 'rating_morph.value');

            $sum = $tmp->value_sum ?? 0;
            // $avg = $tmp->value_avg;
            // @phpstan-ignore-next-line
            $avg = round($tmp->value_sum * 100 / $tmp->value_tot, 2);
            // @phpstan-ignore-next-line
            $count = $tmp->value_count;
            // @phpstan-ignore-next-line
            $tot = $tmp->value_tot;
            // @phpstan-ignore-next-line
            $data = [$rating->id, $rating->title, $rating->pivot->is_winner,  $count, $sum, $avg, $tot];
            $rows[] = $data;
        }
        $this->table($header, $rows);
    }
}
