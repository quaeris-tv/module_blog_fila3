<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Cms\Models\Menu;
use Modules\Cms\Models\Page;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        Page::factory()->create([
            'slug' => 'about',
            'title' => 'About Us',
        ]);

        Page::factory()->create([
            'slug' => 'terms',
            'title' => 'Terms & Conditions',
        ]);

        Menu::create([
            'name' => 'main',
            'items' => [
                [
                    'title' => 'Blog',
                    'url' => '/blog',
                    'type' => 'internal',
                ],
                [
                    'title' => 'About',
                    'url' => '/about',
                    'type' => 'internal',
                ],
                [
                    'title' => 'Contact',
                    'url' => '/contact',
                    'type' => 'internal',
                ],
            ],
        ]);

        Menu::create([
            'name' => 'footer',
            'items' => [
                [
                    'title' => 'Terms & Conditions',
                    'url' => '/terms',
                    'type' => 'internal',
                ],
            ],
        ]);
    }
}
