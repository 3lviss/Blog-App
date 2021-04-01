<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
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
            'user_id' => rand(1, 50),
            'title' => ucfirst($this->faker->word),
            'body' => $this->faker->text($maxNbChars = 500),
            'image' => $this->faker->image('public/storage/posts',992,680, null, false)
        ];
    }
}
