<?php

namespace Tests\Feature\Tweet;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_success(): void
    {
        // テストデータを作成
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Tweet $tweet */
        $tweet = Tweet::factory()->create(['user_id' => $user->id]);

        // 指定したユーザーでログインした状態にする
        $this->actingAs($user);

        $response = $this->delete('/tweet/delete/' . $tweet->id);

        $response->assertRedirect('/tweet');
    }
}
