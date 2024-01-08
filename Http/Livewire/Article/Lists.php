<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Modules\Xot\Actions\GetViewAction;

class Lists extends Component
{
    public const ITEMS_PER_PAGE = 10;

    // All categories
    public $categories;

    // Variables keeping track of the current post query
    public $postCount;

    public $postChunks;

    public $queryCount = 0;

    public $currentChunk = 0;

    // Currently selected category
    public $category;

    // Currently selected order
    public $order = 'date_desc';

    protected $queryString = [
        'category' => ['except' => ''],
        'order' => ['except' => 'date_desc'],
    ];

    public string $tpl;

    public function mount()
    {
        $this->categories = Category::all();
        $this->tpl = 'v1';

        $this->refreshArticles();
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'activeCategory' => $this->getActiveCategory(),
        ];

        return view($view, $view_params);
    }

    public function updatedCategory()
    {
        $this->refreshArticles();
    }

    public function updatedOrder()
    {
        $this->refreshArticles();
    }

    public function loadMore()
    {
        ++$this->currentChunk;
    }

    private function getActiveCategory()
    {
        return $this->categories->first(fn ($i) => $i->slug === $this->category);
    }

    private function getArticleQuery()
    {
        $query = Article::published();

        if ($activeCategory = $this->getActiveCategory()) {
            $query = $query->whereCategoryId($activeCategory->id);
        }

        if ('date_asc' === $this->order) {
            $query = $query->orderBy('published_at', 'asc');
        } else {
            $query = $query->orderBy('published_at', 'desc');
        }

        return $query;
    }

    private function refreshArticles()
    {
        // This will force the update of the `post-chunk` child components
        ++$this->queryCount;
        $this->currentChunk = 0;

        $postIds = $this->getArticleQuery()->pluck('id');
        $this->postCount = $postIds->count();
        $this->postChunks = $postIds->chunk(self::ITEMS_PER_PAGE);
    }
}
