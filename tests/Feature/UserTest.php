<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function only_logged_user_can_see_home_path()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }
}
