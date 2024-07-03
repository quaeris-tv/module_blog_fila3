<?php

declare(strict_types=1);

namespace Modules\Blog\Filament\Blocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;

class ImageSpatie
{
    public static function make(
        string $name = 'image_spatie',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                Forms\Components\Hidden::make('img_uuid')
                    ->default(fn () => Str::uuid()->toString())
                    ->formatStateUsing(fn ($state) => $state ?? Str::uuid()->toString())
                    ->live(),
                // ->required(),

                SpatieMediaLibraryFileUpload::make('image')
                    ->live()
                    ->hiddenLabel()
                    ->imagePreviewHeight('666')
                    ->panelLayout('integrated')
                    ->imageResizeMode('cover')
                    ->panelAspectRatio('2:1')
                    ->maxSize(102400)
                    ->disk('local')
                    ->image()
                    ->preserveFilenames()
                    ->openable()
                    ->downloadable()
                ->collection(fn (Forms\Get $get) => $get('img_uuid')),

                Select::make('ratio')
                    ->options(static::getRatios())
                    ->afterStateHydrated(static fn ($state, $set) => $state || $set('ratio', '4-3')),

                TextInput::make('alt')
                    ->columnSpanFull(),

                TextInput::make('caption')
                    ->columnSpanFull(),

                // Filament\Forms\Components\SpatieMediaLibraryFileUpload::whereCustomProperties does not exist.
                // ->whereCustomProperties(fn(Forms\Get $get) => ['gallery_id' => $get('gallery_id')])

                // ->customProperties(fn(Forms\Get $get) => ['gallery_id' => $get('gallery_id')]),

                // Forms\Components\SpatieMediaLibraryFileUpload::make('media_id')
            ])
            ->columns('form' === $context ? 2 : 1);
    }

    public static function getRatios(): array
    {
        return [
            '4-3' => '4/3',
            '3-4' => '3/4',
            'free' => 'free',
        ];
    }

    public static function getRatioClass(string $ratio): string
    {
        return match ($ratio) {
            '4-3' => 'aspect-[4/3]',
            '3-4' => 'aspect-[3/4]',
            default => '',
        };
    }
}
