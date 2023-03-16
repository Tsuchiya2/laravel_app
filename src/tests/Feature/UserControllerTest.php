<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->createUser();
        $user = \App\Models\User::all()->first();
        $response = $this->get('/users');

        $this->checkCommonDisplay($response);
        $this->checkUserDisplay($response, $user, '一覧ページ');
    }

    public function test_show()
    {
        $this->createUser();
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();
        $response = $this->get("/users/{$user->id}");

        $this->checkCommonDisplay($response);
        $this->checkUserDisplay($response, $user, '詳細ページ');
    }

    public function test_create()
    {
        $response = $this->get("/users/create");
        $this->checkCommonDisplay($response);
    }

    public function test_storeSuccess()
    {
        $attributes = [
            'name' => 'らんてくん',
            'age' => 20,
            'tel' => '08000123456',
            'address' => '東京都港区芝公園４−２−８',
        ];
        $response = $this->post("/users", $attributes);
        $user = \App\Models\User::select('*')->orderBy('id', 'desc')->first();

        $response->assertStatus(302);
        $response->assertRedirect(route("users.show", $user));

        $this->assertSame($user->name, 'らんてくん');
        $this->assertSame($user->age, 20);
    }

    public function test_storeFail()
    {
        $attributes = [
            'name' => '',
            'age' => '30',
        ];

        $this->get("/users/create");
        $this->post("/users", $attributes)
             ->assertStatus(302)
             ->assertRedirect(route("users.create"));
    }

    private function createUser(int $num = 1)
    {
        $count = 0;

        while($count < $num) {
            $user = new User();
            $user->name = "らんてくん{$num}";
            $user->age = $num;
            $user->address = "東京都{$num}区{$num}丁目{$num}番{$num}号";
            $user->tel = "090-1234-{$num}";
            $user->save();

            $count += 1;
        }
    }

    private function checkCommonDisplay($response)
    {
        $response->assertStatus(200);
        $attributes = ['ユーザー名', '年齢', '電話番号', '住所',];
        foreach ($attributes as $attribute) {
            $response->assertSee($attribute, true, "{$attribute}という文字を表示するようにしてください");
        }
    }

    private function checkUserDisplay($response, $user, $page_title)
    {
        $response->assertSee($user->name, true, "${page_title}にユーザー名を表示してください");
        $response->assertSee($user->age, true, "${page_title}に年齢を表示してください");
        $response->assertSee($user->tel, true, "${page_title}に電話番号を表示してください");
        $response->assertSee($user->address, true, "${page_title}に住所を表示してください");
    }
}
