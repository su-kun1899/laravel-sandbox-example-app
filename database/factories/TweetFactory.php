<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['user_id' => "int", 'content' => "string"])]
    public function definition(): array
    {
        return [
            'user_id' => 1, // つぶやきを投稿したユーザーの ID をデフォルトで 1 とする
            'content' => $this->faker->realText(100),
        ];
    }
}
