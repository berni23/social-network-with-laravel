<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'image' =>$this->faker->imageUrl($width = 640, $height = 480),
            'description' =>$this->faker->paragraph(),
            'likes' => $this->faker->randomDigitNotNull(),
            'user_id' => User::all()->random()->id
        ];
    }
}
