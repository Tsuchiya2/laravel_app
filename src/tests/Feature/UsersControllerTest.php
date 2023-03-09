<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function index()
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertSee("RUNTEQ", true, "'RUNTEQ という文字を表示するようにしてください");
    }
}
