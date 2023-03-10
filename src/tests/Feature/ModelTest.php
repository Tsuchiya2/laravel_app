<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ModelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->createUser(6);
        $response = $this->get('/users');

        $this->checkCommonDisplay($response);
        $response->assertSee(10, false, "ユーザーは20歳以上を表示してください");
        $response->assertSee(60, false, "ユーザーは50歳以下を表示してください");
    }

    public function test_storeSuccess()
    {
        $attributes = [
            'name' => 'らんてくん',
            'age' => 20,
        ];
        $response = $this->post("/users", $attributes);
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();

        $response->assertStatus(302);
        $response->assertRedirect(route("users.show", $user));

        $this->assertSame($user->name, 'らんてくん');
        $this->assertSame($user->age, 20);
    }

    private function createUser(int $num = 1)
    {
        $count = 0;

        while($count < $num) {
            $user = new User();
            $user->name = "らんてくん{$num}";
            $user->age = ($num + 1) * 10;
            $user->save();

            $count += 1;
        }
    }

    private function checkCommonDisplay($response)
    {
        $response->assertStatus(200);
        $attributes = ['ユーザー名', '年齢'];
        foreach ($attributes as $attribute) {
            $response->assertSee($attribute, true, "{$attribute}という文字を表示するようにしてください");
        }
    }
}
