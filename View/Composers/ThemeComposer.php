<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Blog\Datas\ArticleData;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Banner;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Menu;
use Modules\Blog\Models\Page;
use Modules\Blog\Models\Profile;
use Modules\Blog\Models\Tag;
use Modules\UI\Datas\SliderData;
use Modules\UI\Datas\SliderDataCollection;

use function Safe\json_decode;

use Spatie\LaravelData\DataCollection;
use Webmozart\Assert\Assert;

class ThemeComposer
{
    /**
     * Show recent categories with their latest .
     *
     * @return Collection<int, Category>
     */
    public function categories()
    {
        $categories = Category::tree()->get()->toTree();

        return $categories;
    }

    /**
     * Show recent categories with their latest .
     *
     * @return Collection<int, Category>
     */
    public function getCategoriesArticles()
    {
        return $this->categories();
    }

    public function getArticles(): Collection
    {
        return Article::all()
            ->sortBy(['created_at', 'desc'])
        ;
    }

    public function getArticlesType(string $type, int $number = 6): Collection
    {
        $fun = 'get'.Str::studly($type).'Articles';

        return $this->{$fun}($number);
    }

    public function getFeaturedArticles(int $number = 6): Collection
    {
        $rows = Article::published()
            ->showHomepage()
            ->publishedUntilToday()
            ->take($number)
            ->orderBy('published_at', 'desc')
            ->get();
        if (0 === $rows->count()) {
            $rows = Article::get();
            Article::whereRaw('1=1')->update(['show_on_homepage' => true]);
        }

        return $rows;
    }

    public function getLatestArticles(int $number = 6): Collection
    {
        $rows = Article::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();

        return $rows;
    }

    public function getArticlesByCategory(string $category_id, int $number = 6): array
    {
        $rows = Article::where('category_id', $category_id)
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($rows);
    }

    public function paginateArticlesByCategory(string $category_id, int $limit = 6): Paginator|array
    {
        return Article::where('category_id', $category_id)
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
    }

    /*
    public function getAuthors(): Collection
    {
        $rows = Profile::ProfileIsAuthor()
            ->take(4)
            ->get();

        return $rows;
    }
    */

    public function getNavCategories(): Collection
    {
        $navCategories = Category::has('articles', '>', 0)
            ->take(8)
            ->get();

        return $navCategories;
    }

    public function getFooterCategories(): Collection
    {
        $footerCategories = Category::has('articles', '>', 0)
            ->take(8)
            ->get();

        return $footerCategories;
    }

    // --- da fare con parental
    public function getFooterAuthors(): Collection
    {
        // $footerAuthors = Profile::profileIsAuthor()
        // ->take(8)
        $footerAuthors = Profile::take(8)
            ->get();

        return $footerAuthors;
    }

    public function getTags(): Collection
    {
        return Tag::all();
    }

    public function getFooterTags(): Collection
    {
        $footerTags = Tag::take(15)->get();

        return $footerTags;
    }

    /**
     * @return \Illuminate\Support\Collection<(int|string), mixed>
     */
    public function getMoreArticles(Model $model)
    {
        return collect([]);
    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator<Article>
     */
    public function getPaginatedArticles(int $num = 15)
    {
        return Article::paginate($num);
    }

    public function showPageContent(string $slug): \Illuminate\Contracts\Support\Renderable
    {
        Assert::isInstanceOf($page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]), Page::class);
        // $page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]);
        $blocks = $page->content_blocks;
        if (! is_array($blocks)) {
            $blocks = [];
        }
        $page = new \Modules\UI\View\Components\Render\Blocks(blocks: $blocks, model: $page);

        return $page->render();
    }

    public function showPageSidebarContent(string $slug): \Illuminate\Contracts\Support\Renderable
    {
        Assert::isInstanceOf($page = Page::firstOrCreate(['slug' => $slug], ['sidebar_blocks' => []]), Page::class);
        // $page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]);

        $page = new \Modules\UI\View\Components\Render\Blocks(blocks: $page->sidebar_blocks, model: $page);

        return $page->render();
    }

    public function showArticleSidebarContent(string $slug): \Illuminate\Contracts\Support\Renderable
    {
        Assert::isInstanceOf($article = Article::firstOrCreate(['slug' => $slug], ['sidebar_blocks' => []]), Article::class);
        // $page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]);

        $article = new \Modules\UI\View\Components\Render\Blocks(blocks: $article->sidebar_blocks, model: $article);

        return $article->render();
    }

    public function getPages(): Collection
    {
        $pages = Page::all();

        return $pages;
    }

    public function getPageModel(string $slug): ?Page
    {
        return Page::where('slug', $slug)->first();
    }

    public function getUrlPage(string $slug): string
    {
        $page = $this->getPageModel($slug);
        if (null !== $page) {
            return '/'.app()->getLocale().'/pages/'.$slug;
        }

        return '#';
    }

    public function rankingProfilesByCredits(): Collection
    {
        $profiles = Profile::all()->sortByDesc('credits');

        return $profiles;
    }

    public function rankingArticlesByBets(): Collection
    {
        $var = Article::withCount([
            'ratings' => function (Builder $builder) {
                $builder->where('user_id', '!=', null);
            },
        ])
                ->get()
                ->sortByDesc('ratings_count')
        ;

        return $var;
    }

    public function getMethodData(string $method, int $number = 6): Paginator|array
    {
        return $this->{$method}($number);
    }

    public function getBanner_OLD(): array
    {
        $pub_theme = config('xra.pub_theme');
        $path = base_path('Themes/'.$pub_theme.'/Resources/json/banner.json');

        Assert::isArray($contents = json_decode(File::get($path), true));
        // dddx($contents);
        // dddx(json_decode($contents));
        // dddx(SliderDataCollection::from($contents));
        $tmp = [];
        foreach ($contents as $content) {
            // dddx($content);
            $tmp[] = SliderData::from($content);
        }

        return $tmp;
        // dddx($tmp);
        // dddx(SliderDataCollection::collect($tmp,DataCollection::class));
        // $results = SliderDataCollection::collect($tmp,DataCollection::class);
        // foreach($results as $result){
        //     dddx($result->slider_data);
        // }

        // return SliderDataCollection::collect($tmp,DataCollection::class);
    }

    public function getBanner(): array
    {
        $results = Banner::all()->toArray();
        $tmp = [];
        foreach ($results as $content) {
            $tmp[] = SliderData::from($content);
        }

        return $tmp;
    }

    public function getSingleBanner(Banner $banner): SliderData
    {
        return SliderData::from($banner->toArray());
    }

    public function getArticlesFeatured(int $number = 6): Collection
    {
        dddx('wip con article data');

        return $this->getFeaturedArticles($number);
    }

    public function getArticlesLatest(int $number = 6): array
    {
        $results = $this->getLatestArticles($number); // ->toArray();

        return $this->getArticleDataArray($results);
    }

    public function paginatedArticlesLatest(int $limit = 6): Paginator
    {
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesComingSoon(int $limit = 6): Paginator
    {
        return Article::published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesOrderByNumberOfBets(int $limit = 6): Paginator
    {
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->simplePaginate($limit);
    }

    public function paginatedArticlesOrderByVolumes(int $limit = 6): Paginator
    {
        return Article::published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->simplePaginate($limit);
    }

    public function mapArticle(Article $article): ArticleData
    {
        $article = $article->toArray();

        if (is_array($article['title'])) {
            $lang = app()->getLocale();
            $article['title'] = $article['title'][$lang] ?? last($article['title']);
        }

        return ArticleData::from($article);
    }

    public function getArticlesComingSoon(int $number = 6): array
    {
        $results = Article::published()
            ->where('event_start_date', '>', now())
            ->orderBy('event_start_date')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    public function getArticlesOrderByNumberOfBets(int $number = 6): array
    {
        $results = Article::published()
            ->publishedUntilToday()
            ->orderBy('wagers_count', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    public function getArticlesOrderByVolumes(int $number = 6): array
    {
        $results = Article::published()
            ->publishedUntilToday()
            ->orderBy('volume_play_money', 'desc')
            ->take($number)
            ->get();

        return $this->getArticleDataArray($results);
    }

    public function getAllArticles(): array
    {
        $results = Article::orderBy('created_at', 'desc')->get();

        return $this->getArticleDataArray($results);
    }

    public function getArticleDataArray(Collection $rows): array
    {
        $tmp = [];
        foreach ($rows->toArray() as $content) {
            if (is_array($content['title'])) {
                $lang = app()->getLocale();
                $content['title'] = $content['title'][$lang] ?? last($content['title']);
            }
            // dddx([
            //     $rows,
            //     $rows->toArray(),
            //     $content,
            //     // ArticleData::from($content)
            // ]);
            $tmp[] = ArticleData::from($content);
        }

        // dddx($tmp);
        return $tmp;
    }

    public function getArticleModel(string $slug): ?Article
    {
        return Article::where('slug', $slug)->first();
    }

    public function getCategoryModel(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    /**
     * Undocumented function.
     *
     * @return array|null
     */
    public function getMenu(string $menu_name)
    {
        $menu = Menu::where('title', $menu_name)->first();
        if (null == $menu) {
            $menu = Menu::create(['title' => $menu_name]);
        }

        return $menu->items ?? [];
    }

    public function getHotTopics(): array
    {
        return $categories = Category::with([
            'categoryArticles' => fn ($article) => $article->withCount('ratings'),
            // 'banner'
        ])
            ->get()
            ->map(fn ($category) => [
                'image' => $category->getFirstMediaUrl('category'), // ?? 'https://placehold.co/300x200',
                'slug' => $category->slug,
                'title' => $category->title,
                'ratings_sum' => $category->categoryArticles->sum('ratings_count'),
            ])
            ->sortByDesc('ratings_sum')
            ->take(3)
            ->toArray();
    }
}
