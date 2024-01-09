<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Webmozart\Assert\Assert;

class TextWidget extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'key',
        'image',
        'title',
        'content',
        'active',
    ];

    public static function getTitle(string $key): ?string
    {
        $widget = self::query()->where('key', $key)->first();

        if (! $widget) {
            return '';
        }

        return $widget->title;
    }

    public static function getContent(string $key): ?string
    {
        $widget = Cache::get('text-widget-'.$key, fn () => self::query()->where('key', $key)->first());

        if (! $widget) {
            return '';
        }
        Assert::isInstanceOf($widget, self::class);

        return $widget->content;
    }
}
