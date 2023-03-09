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
        $this->createUser();

        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertSee("RUNTEQ", true, "'RUNTEQ という文字を表示するようにしてください");
    }

    private function createUser(integer $num = 1)
    {
        $faker = Faker\Factory::create('ja_JP');

        $count = 0;
        while($count < $num) {
            $user = new User();
            $user->name = $faker->name();
            $user->tel = $faker->phoneNumber();
            $user->save();

            $count += 1;
        }
    }
}
