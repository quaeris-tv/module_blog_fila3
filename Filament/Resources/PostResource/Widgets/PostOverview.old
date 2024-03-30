<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Resources\PostResource\Widgets;

use Filament\Widgets\Widget;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\PostView;
use Modules\Blog\Models\UpvoteDownvote;

class PostOverview extends Widget
{
    public Post $record;

    protected int|string|array $columnSpan = 3;

    protected static string $view = 'blog::filament.resources.post-resource.widgets.post-overview';

    protected function getViewData(): array
    {
        return [
            'viewCount' => PostView::where('post_id', '=', $this->record->id)->count(),
            'upvotes' => UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 1)->count(),
            'downvotes' => UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', 0)->count(),
        ];
    }
}
