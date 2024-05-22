<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Livewire\Component;
use Modules\Xot\Actions\GetViewAction;

class Chart extends Component
{
    public string $tpl = 'v1';

    public string $type;

    public array $subscriptions = [
        ['Day' => 'Mon', 'Value' => 10],
        ['Day' => 'Tue', 'Value' => 20],
        ['Day' => 'Wed', 'Value' => 15],
        ['Day' => 'Thu', 'Value' => 25],
        ['Day' => 'Fri', 'Value' => 30],
        ['Day' => 'Sat', 'Value' => 22],
        ['Day' => 'Sun', 'Value' => 18],
    ];

    public function mount(string $type_chart): void
    {
        $this->tpl = $type_chart;
        $this->type = $type_chart;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
