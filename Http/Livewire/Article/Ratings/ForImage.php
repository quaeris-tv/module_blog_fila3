<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article\Ratings;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Arr;
use Modules\Blog\Aggregates\ArticleAggregate;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

/**
 * @property ComponentContainer $form
 */
class ForImage extends Page implements HasForms
{
    use InteractsWithForms;
    public Article $article;

    public string $tpl = 'v1';
    public string $user_id;
    public array $data = [];
    public Profile $profile;
    public array $article_ratings = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'filament.pages.edit-company';

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
        // // dddx($ratings);
        // $data = [];
        // $data['ratings'] = $profile_ratings;
        // dddx($data);


        $this->article_ratings = $this->article
            ->ratings()
            ->where('user_id', null)
            ->distinct()
            ->get()
            ->toArray();
        // dddx($article_ratings);

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

    public function url(string $name, array $params): string
    {
        return '#';
    }

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

    public function save(): void
    {
        $data = $this->form->getState();
        dddx($data);
        $article_aggregate = ArticleAggregate::retrieve($this->article->id);
        Assert::isArray($ratings_add = $data['ratings_add']);
        foreach ($ratings_add as $rating_id => $rating) {
            $credit = $rating['value'];
            if (null != $credit) {
                $command = RatingArticleData::from([
                    'userId' => $this->user_id,
                    'articleId' => $this->article->id,
                    'ratingId' => $rating_id,
                    'credit' => $credit,
                ]);

                $article_aggregate->rating($command);
            }
        }

        //    auth()->user()->company->update($data);
        // } catch (Halt $exception) {
        //    return;
        // }
    }
}
