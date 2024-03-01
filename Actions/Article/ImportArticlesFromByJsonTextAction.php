<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Article;

use Carbon\Carbon;
use Webmozart\Assert\Assert;
use Spatie\QueueableAction\QueueableAction;

class ImportArticlesFromByJsonTextAction
{
    use QueueableAction;

    public function execute(string $json_text): void
    {
        Assert::isArray($json = json_decode($json_text, true));

        foreach ($json as $j) {

            $bet_end_date = $j['bet_end_date'] ?? '';
            if (\is_string($bet_end_date) && \strlen($bet_end_date) > 3) {
                $bet_end_date = Carbon::parse($bet_end_date);
            }
            $event_start_date = $j['event_start_date'] ?? '';
            if (\is_string($event_start_date) && \strlen($event_start_date) > 3) {
                $event_start_date = Carbon::parse($event_start_date);
            }
            $event_end_date = $j['event_end_date'] ?? '';
            if (\is_string($event_end_date) && \strlen($event_end_date) > 3) {
                $event_end_date = Carbon::parse($event_end_date);
            }

            $article_where = [
                'title' => $j['title'],
                'slug' => $j['slug'],
            ];

            $article_data = [
                'title' => $j['title'],
                'slug' => $j['slug'],
                'status' => $j['status'],
                'status_display' => ($j['status_display'] == 'open') ? true : false,
                'bet_end_date' => $bet_end_date,
                'event_start_date' => $event_start_date,
                'event_end_date' => $event_end_date,
                'is_wagerable' => $is_wagerable,

            ];
        }
    }
}
