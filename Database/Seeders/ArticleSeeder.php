<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;

class ArticleSeeder extends Seeder
{
    private array $categories = [
        ['name' => 'Animals', 'image' => 'https://picsum.photos/id/219/800/600'],
        ['name' => 'Mountains', 'image' => 'https://picsum.photos/id/353/800/600'],
        ['name' => 'People', 'image' => 'https://picsum.photos/id/342/800/600'],
        ['name' => 'Things', 'image' => 'https://picsum.photos/id/252/800/600'],
    ];

    private Carbon $date;

    public function run(): void
    {
        $this->date = Carbon::now();

        foreach ($this->categories as $category) {
            Category::create([
                'title' => $category['name'],
                'slug' => Str::slug($category['name']),
            ]);
        }

        // Featured posts
        for ($i = 0; $i < 2; ++$i) {
            $this->createArticle(['is_featured' => 1]);
        }

        // Published posts
        for ($i = 0; $i < 26; ++$i) {
            $this->createArticle();
        }

        // Draft posts
        for ($i = 0; $i < 2; ++$i) {
            $this->createArticle(['published_at' => null]);
        }
    }

    /**
     * @return Collection <Article>
     */
    private function createArticle(array $data = []): Collection
    {
        $date = $this->date->subDay();

        $category_key = array_rand($this->categories);

        $defaults = [
            'created_at' => $date,
            'updated_at' => $date,
            'published_at' => $date,
            // 'category_id' => $category_key + 1,
            'main_image_url' => $this->categories[$category_key]['image'],
        ];

        $data = array_merge($defaults, $data);

        return Article::factory()->create($data);
    }
}
