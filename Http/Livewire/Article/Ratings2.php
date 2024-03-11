<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Blog\Aggregates\ArticleAggregate;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

class Ratings2 extends Component
{
    use InteractsWithForms;
    public Article $article;

    public string $tpl = 'v1';
    // public string $user_id;
    public Collection $datas;
    // public Profile $profile;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(Article $article, string $tpl = 'v1'): void
    {
        $this->article = $article;
        $this->tpl = $tpl;
        // $this->user_id = (string) Filament::auth()->id();
        // $this->profile = Profile::firstOrCreate(['user_id' => $this->user_id]);
        // $profile_ratings = $this->profile
        //     ->ratings()
        //     ->select('rating_id as id', 'value')
        //     ->get()
        //     ->keyBy('id')
        //     ->toArray();
        // dddx($ratings);
        // $data = [];
        // $data['ratings'] = $profile_ratings;

        $this->datas = $this->article
            ->ratings()
            // ->with('media')
            ->where('user_id', null)
            // ->distinct()
            ->get()
            // ->toArray()
        ;

        // dddx($ratings);

        // $this->form->fill(auth()->user()->company->attributesToArray());
        // $this->form->fill($data);
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

    // public function url(string $name, array $params): string
    // {
    //     return '#';
    // }

    // public function form(Form $form): Form
    // {
    //     $ratings = $this->article
    //         ->ratings()
    //         ->where('user_id', null)
    //         ->distinct()
    //         ->get();

    //     $schema = [];
    //     foreach ($ratings as $rating) {
    //         /*
    //         $schema[] = TextInput::make('ratings.'.$rating->id.'.value')
    //             ->label($rating->title.' tot ')
    //             ->extraInputAttributes(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-700 focus:ring-green-700 sm:text-sm'])
    //             ->disabled();
    //         */
    //         /*
    //         $schema[]=TextInput::make('ratings_add.'.$rating->id.'.id')
    //             ->default($rating->id);
    //         */
    //         $schema[] = TextInput::make('ratings_add.'.$rating->id.'.value')
    //             ->label($rating->title)
    //             ->suffix(fn () => Arr::get($this->data, 'ratings.'.$rating->id.'.value', 0))
    //             // ->extraInputAttributes(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-700 focus:ring-green-700 sm:text-sm'])
    //             // ->disabled()
    //         ;
    //     }

    //     // dddx($schema);
    //     return $form
    //         ->schema($schema)
    //         ->statePath('data');
    // }

    // protected function getFormActions(): array
    // {
    //     return [
    //         Action::make('save')
    //             ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
    //             ->submit('save'),
    //     ];
    // }

    public function bet(int $rating_id, string $rating_title): void
    {
        $this->dispatch('bet-created', 
            // rating_id: $rating_id, 
            rating_title: $rating_title
        );
    }

    // public function save(): void
    // {
    //     dddx('save');
        // $data = $this->form->getState();
        // $article_aggregate = ArticleAggregate::retrieve($this->article->id);
        // Assert::isArray($ratings_add = $data['ratings_add']);
        // foreach ($ratings_add as $rating_id => $rating) {
        //     $credit = $rating['value'];
        //     if (null != $credit) {
        //         $command = RatingArticleData::from([
        //             'userId' => $this->user_id,
        //             'articleId' => $this->article->id,
        //             'ratingId' => $rating_id,
        //             'credit' => $credit,
        //         ]);

        //         $article_aggregate->rating($command);
        //     }
        // }

        //    auth()->user()->company->update($data);
        // } catch (Halt $exception) {
        //    return;
        // }
    // }
}
