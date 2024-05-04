<?php

declare(strict_types=1);

namespace Modules\Blog\Projectors;

use Carbon\Carbon;
use Modules\Blog\Events\Article\CloseArticle;
use Modules\Blog\Events\ArticleRegistered;
use Modules\Blog\Events\ProductReplenished;
use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Events\RatingArticleWinner;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Transaction;
use Modules\Rating\Actions\HasRating\GetSumByModelRatingIdAction;
use Modules\Rating\Models\RatingMorph;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Webmozart\Assert\Assert;

class ArticleProjector extends Projector
{
    // public function onProductRegistered(ArticleRegistered $event): void
    // {
    //     $data = (array) $event;

    //     Article::create($data);
    // }

    public function onRatingArticle(RatingArticle $event): void
    {
        RatingMorph::firstOrCreate(
            [
                'rating_id' => $event->ratingId,
                'model_type' => 'article',
                'model_id' => $event->articleId,
                'user_id' => $event->userId,
            ],
            [
                'value' => 0,
            ]
        )->increment('value', $event->credit);

        Transaction::create(
            [
                'model_type' => 'article',
                'model_id' => $event->articleId,
                'user_id' => $event->userId,
                'date' => Carbon::now(),
                'credits' => $event->credit * -1,
                'note' => 'rating_article',
            ]
        );
    }

    public function onRatingArticleWinner(RatingArticleWinner $event): void
    {
        $rating_morph = RatingMorph::firstWhere([
            'rating_id' => $event->ratingId,
            'model_type' => 'article',
            'model_id' => $event->articleId,
            'user_id' => null,
        ]);

        Assert::notNull($rating_morph);

        $data = [
            'rating_id' => $event->ratingId,
            'model_type' => 'article',
            'model_id' => $event->articleId,
        ];
        Assert::notNull($record = Article::firstWhere(['id' => $event->articleId]));

        $winners = RatingMorph::where($data)->where('user_id', '!=', null)->get();
        $tot_win = app(GetSumByModelRatingIdAction::class)->execute($record, $event->ratingId);
        $tot = app(GetSumByModelRatingIdAction::class)->execute($record);
        foreach ($winners as $winner) {
            $reward = $winner->value / $tot_win * $tot;
            $winner->update([
                'is_winner' => true,
                'reward' => $reward,
            ]);
            Assert::notNull($profile = $winner->profile);
            $profile->increment('credits', $reward);


            Transaction::create(
                [
                    'model_type' => 'article',
                    'model_id' => $event->articleId,
                    'user_id' => $profile->user->id,
                    'date' => Carbon::now(),
                    'credits' => $reward,
                    'note' => 'rating_article_winner',
                ]
            );


        }
        $record->update(['rewarded_at' => now()]);
        $rating_morph->is_winner = true;
        $rating_morph->save();


    }

    // public function onCloseArticle(CloseArticle $event): void
    // {
    //     $article = Article::find($event->articleId);
    //     $article->is_closed = true;
    //     $article->save();
    // }

    // public function onProductReplenished(ProductReplenished $event)
    // {
    // Product::withProductId($event->productId)
    //    ->incrementAvailability($event->quantity);
    // }
}
