<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\PostView;

class PostViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = PostView::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip_address' => $this->faker->word,
            // 'user_agent' => $this->faker->useragent,
            'post_id' => $this->faker->randomNumber(5),
            'user_id' => $this->faker->randomNumber(5),
        ];
    }
}
