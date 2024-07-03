<?php

declare(strict_types=1);

namespace Modules\Blog\Actions\Block;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\QueueableAction\QueueableAction;

class GetAllBlocksAction
{
    use QueueableAction;

    public function execute(string $context = 'form'): array
    {
        $files = File::glob(base_path('Modules').'/*/Filament/Blocks/*.php');
        $blocks = Arr::map($files,
            function ($path) {
                $class = Str::of($path)
                ->after(base_path('Modules'))
                ->prepend('\Modules')
                ->before('.php')
                ->replace('/', '\\')
                ->toString();

                $name = Str::of(class_basename($class))->snake()->toString();
                if (Str::endsWith($name, '_block')) {
                    $name = Str::before($name, '_block');
                }

                $module = Str::of($class)->between('Modules\\', '\Filament\\')->toString();

                /*

                $name2 = $ns::make()->getName();

                if ($name !== $name2) {
                    dddx([
                        'ns' => $ns,
                        'block' => $block,
                        'name' => $name,
                        'test' => $name2,
                    ]);
                }

                // */
                // return $ns::make(name: $name, context: $context);
                return [
                    'name' => $name,
                    'class' => $class,
                    'module' => $module,
                    'path' => $path,
                ];
            }
        );

        return $blocks;
    }
}
