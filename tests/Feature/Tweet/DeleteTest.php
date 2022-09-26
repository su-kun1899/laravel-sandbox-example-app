<?php

namespace Tests\Feature\Tweet;

use Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_success(): void
    {
        $response = $this->get('/tweet/delete/1');

        $response->assertRedirect('/tweet');
    }
}
