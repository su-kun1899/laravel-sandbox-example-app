<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // ディレクトリがなければ作成する
        if (!Storage::exists('public/images')) {
            Storage::makeDirectory('public/images');
        }

        echo $this->faker->imageUrl();

        return [
            'name' => $this->faker->image(storage_path('app/public/images'), 640, 480, null, false),
        ];
    }
}
