<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

use Illuminate\Support\Str;
use Modules\Blog\Models\Tag;
use Webmozart\Assert\Assert;
use Modules\Blog\Models\Page;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Modules\Blog\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Database\Eloquent\Builder;

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

    public function getFooterAuthors(): Collection
    {
        $footerAuthors = Profile::profileIsAuthor()
            ->take(8)
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
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedArticles(int $num = 15)
    {
        return Article::paginate($num);
    }

    public function showPageContent(string $slug): \Illuminate\Contracts\Support\Renderable
    {
        Assert::isInstanceOf($page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]), Page::class);
        // $page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]);
        $page = new \Modules\UI\View\Components\Render\Blocks(blocks: $page->content_blocks, model: $page);

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

    public function getUrlPage(string $slug): string
    {
        $page = $this->getPages()->where('slug', $slug)->first();
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

    public function getBanners(){
        $pub_theme = config('xra.pub_theme');
        $path = base_path('Themes/'.$pub_theme.'/Resources/json/banner.json');

        $contents = File::get($path);
        // dddx($contents);
        dddx(json_decode($contents));
    }
}