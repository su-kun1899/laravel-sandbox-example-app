<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('tweets')->insert(
            [
                'content' => Str::random(100),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
