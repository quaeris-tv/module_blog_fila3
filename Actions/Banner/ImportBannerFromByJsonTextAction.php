<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Banner;

use Carbon\Carbon;
use Modules\Blog\Models\Banner;
use Modules\Blog\Models\Category;

use function Safe\json_decode;

use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

class ImportBannerFromByJsonTextAction
{
    use QueueableAction;

    public function execute(string $json_text): void
    {
        Assert::isArray($json = json_decode($json_text, true), '['.__LINE__.']['.__FILE__.']');

        foreach ($json as $j) {
            $start_date = $j['start_date'] ?? '';
            if (\is_string($start_date) && mb_strlen($start_date) > 3) {
                $start_date = Carbon::parse($start_date);
            }
            $end_date = $j['end_date'];
            if (\is_string($end_date) && mb_strlen($end_date) > 3) {
                $end_date = Carbon::parse($end_date);
            }

            $cd = $j['category_dict'] ?? [];

            $category_data = [
                'title' => $cd['title'] ?? '',
                'slug' => $cd['slug'] ?? '',
                // "in_leaderboard"=> $cd['in_leaderboard'],
                // "icon"=>$cd['icon'],
            ];
            $category_where = ['slug' => $category_data['slug']];
            $category = Category::firstOrCreate($category_where, $category_data);

            $banner_where = [
                'title' => $j['title'],
                'action_text' => $j['action_text'],
            ];
            $banner_data = [
                'title' => $j['title'],
                'description' => $j['short_description'],
                'action_text' => $j['action_text'],
                'link' => $j['link'],
                'start_date' => $start_date,
                'end_date' => $end_date,
                'hot_topic' => $j['hot_topic'],
                'open_markets_count' => $j['open_markets_count'],
                'landing_banner' => $j['landing_banner'],
                'category_id' => $category->id,
            ];

            Banner::firstOrCreate($banner_where, $banner_data)
                ->addMediaFromUrl($j['desktop_thumbnail'])
                ->toMediaCollection('banner');

            // $banner->addMediaFromUrl($j['desktop_thumbnail']);
        }
    }
}
