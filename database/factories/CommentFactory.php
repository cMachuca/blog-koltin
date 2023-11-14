<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commnetableType = fake()->randomElement(['users', 'posts']);
        $commentable = $commnetableType === 'users' ? User::factory()->create() : Post::factory()->create();

        return [
            'user_id' => User::factory(),
            'content' => fake()->text(),
            'commentable_type' => $commnetableType,
            'commentable_id' => $commentable->id,
        ];
    }
}