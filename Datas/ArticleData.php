<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

<<<<<<< HEAD
use Illuminate\Support\Collection;
use Modules\Blog\Actions\Category\GetBloodline;
=======
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Blog\Actions\Category\GetBloodline;
use Modules\Blog\Models\Article;
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
use Modules\Blog\Models\Category;
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;

class ArticleData extends Data
{
<<<<<<< HEAD
    public function __construct(
        public string $title,
        public string $slug,
        public int $category_id,
=======
    public string $title = '';

    public function __construct(
        public string $id,
        public string $uuid,
        array|string $title,
        public string $slug,
        public ?int $category_id,
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
        public ?string $status,
        public bool $show_on_homepage,
        public string $published_at,
        public ?array $content_blocks,
        public ?array $sidebar_blocks,
        public ?array $footer_blocks,
        public ?Collection $categories,
        public ?string $url,
<<<<<<< HEAD
=======
        public ?array $ratings,
        public ?string $closed_at,
<<<<<<< HEAD
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
=======
        public ?string $closed_at_date,
        public ?int $betting_users,
        public ?string $time_left_for_humans,
        public ?float $volume_credit,
>>>>>>> dev
        // public string $class,
        // public string $articleId;
        // public string $ratingId;
        // public int $credit;
    ) {
<<<<<<< HEAD
        // $this->url = $this->getUrl();
        $this->categories = $this->getCategories();
=======
        if (is_array($title)) {
            $lang = app()->getLocale();
            $title = $title[$lang] ?? last($title);
        }
        if (is_string($title)) {
            $this->title = $title;
        }
        // $this->url = $this->getUrl();
        $this->categories = $this->getCategories();
<<<<<<< HEAD
        $this->ratings = $this->getRatings();
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
=======

        $this->closed_at_date = Carbon::parse($this->closed_at)->format('Y-m-d');

        Assert::notNull($article = Article::where('uuid', $this->uuid)->first());
        $this->betting_users = $article->getBettingUsers();
        $this->ratings = $article->getArrayRatingsWithImage();
        $this->time_left_for_humans = $article->getTimeLeftForHumans();
        $this->volume_credit = $article->getVolumeCredit();
>>>>>>> dev
    }

    public function getCategories(): Collection
    {
        return app(GetBloodline::class)->execute($this->category_id);

        // Assert::notNull($category = Category::find($this->category_id));

        // return $category->bloodline()->get()->reverse();
    }

<<<<<<< HEAD
<<<<<<< HEAD
    public function url(string $type): string
    {
        if ('show' == $type) {
            return '/'.app()->getLocale().'/article/'.$this->slug;
        }

        if ('edit' == $type) {
            return '/'.app()->getLocale().'/article/'.$this->slug.'/edit';
        }

        return '#';
    }
=======
    public function getArticle(): Article
    {
        Assert::notNull($article = Article::where('uuid', $this->uuid)->first());
=======
    // public function getArticle(): Article
    // {
    //     Assert::notNull($article = Article::where('uuid', $this->uuid)->first());
>>>>>>> dev

    //     return $article;
    // }

    // public function getRatings(): array
    // {
    //     return $this->getArticle()->getArrayRatingsWithImage();
    // }

    // public function getBettingUsers(): int
    // {
    //     return $this->getArticle()->getBettingUsers();
    // }

    public function url(string $type): string
    {
        $lang = app()->getLocale();
        if ('show' == $type) {
            return '/'.$lang.'/article/'.$this->slug;
        }

        // if ('edit' == $type) { // NON ESISTE EDIT NEL FRONTEND !!!
        //    return '/'.$lang.'/article/'.$this->slug.'/edit';
        // }

        return '#';
    }

    // public function getClosedAt(): string
    // {
    //     return $carbonDate = Carbon::parse($this->closed_at)->format('Y-m-d');
    // }

<<<<<<< HEAD
    public function getTimeLeftForHumans(): string
    {
        return $this->getArticle()->getTimeLeftForHumans();
    }
>>>>>>> 7412b571dbd0d1aeed5cc5b29b0f126002e09083
=======
    // public function getTimeLeftForHumans(): string
    // {
    //     dddx('a');
    //     return $this->getArticle()->getTimeLeftForHumans();
    // }
>>>>>>> dev
}
