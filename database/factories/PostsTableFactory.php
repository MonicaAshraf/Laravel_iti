<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use Illuminate\Support\Str;

class PostsTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' =>  $this->faker->sentence(5),
            'description' =>  $this->faker->sentence(15),
            'user_id' => \App\Models\User::all()->random()->id,
        ];
    }
}
