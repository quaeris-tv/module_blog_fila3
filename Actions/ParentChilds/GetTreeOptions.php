<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\ParentChilds;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueueableAction\QueueableAction;

class GetTreeOptions
{
    use QueueableAction;

    public function execute(Model $model): array
    {
        // @phpstan-ignore staticMethod.notFound
        $models = $model::tree()->get()->toTree();
        $results = [];
        foreach ($models as $mod) {
            $results[$mod->id] = $mod->title;
            foreach ($mod->children as $child) {
                $results[$child->id] = '--------->'.$child->title;
                foreach ($child->children as $cld) {
                    $results[$cld->id] = '----------------->'.$cld->title;
                    foreach ($cld->children as $c) {
                        $results[$c->id] = '------------------------->'.$c->title;
                    }
                }
            }
        }

        return $results;
    }
}
