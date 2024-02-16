<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Modules\Xot\Actions\GetViewAction;

class Lists extends Component
{
    public const ITEMS_PER_PAGE = 10;

    // All categories
    /**
     * @var Collection<Category>
     */
    public Collection $categories;

    // Variables keeping track of the current post query
    public int $postCount = 0;

    /**
     * @var \Illuminate\Support\Collection<int,\Illuminate\Support\Collection>
     */
    public \Illuminate\Support\Collection $postChunks;

    public int $queryCount = 0;

    public int $currentChunk = 0;

    // Currently selected category
    public ?Category $category = null;

    // Currently selected order
    public string $order = 'date_desc';

    /**
     * @var array
     */
    protected $queryString = [
        'category' => ['except' => ''],
        'order' => ['except' => 'date_desc'],
    ];

    public string $tpl;

    public function mount(): void
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

    public function updatedCategory(): void
    {
        $this->refreshArticles();
    }

    public function updatedOrder(): void
    {
        $this->refreshArticles();
    }

    public function loadMore(): void
    {
        ++$this->currentChunk;
    }

    private function getActiveCategory(): Category|null
    {
        // return $this->categories->first(fn ($i) => $i->slug === $this->category);
        return $this->category;
    }

    private function getArticleQuery(): Builder
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

    private function refreshArticles(): void
    {
        // This will force the update of the `post-chunk` child components
        ++$this->queryCount;
        $this->currentChunk = 0;

        $postIds = $this->getArticleQuery()->pluck('id');
        $this->postCount = $postIds->count();
        $this->postChunks = $postIds->chunk(self::ITEMS_PER_PAGE);
    }
}
