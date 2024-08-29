<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Headernav;

use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\On;
use Livewire\Component;
use Modules\Blog\Actions\Profile\UpdateCreditsField;
use Modules\Blog\Models\Profile;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

class Credits extends Component
{
    public string $tpl = 'v1';

    public Profile $profile;

    public function mount(Profile $profile): void
    {
        $this->profile = $profile;
    }

    public function render(): Renderable
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        // $credits = number_format($this->profile->credits, 0);
        $credits = $this->getCredits();

        $view_params = [
            'credits' => $credits,
        ];

        return view($view, $view_params);
    }

    #[On('refresh-credits')]
    public function getCredits(): string|float
    {
        Assert::notNull($user_id = $this->profile->user_id, '['.__LINE__.']['.__FILE__.']');
        app(UpdateCreditsField::class)->execute($user_id);

        return $this->profile->credits;
    }
}
