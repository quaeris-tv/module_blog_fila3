<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'thumbnail' => $this->faker->word,
            'body' => $this->faker->text,
            'user_id' => $this->faker->randomNumber(5),
            'active' => $this->faker->boolean,
            'published_at' => $this->faker->dateTime,
            'meta_title' => $this->faker->word,
            'meta_description' => $this->faker->word,
        ];
    }
}
