<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'user_id' => 1, // つぶやきを投稿したユーザーの ID をデフォルトで 1 とする
            'content' => $this->faker->realText(100),
            'created_at' => Carbon::now()->addDays(-1),
        ];
    }
}
