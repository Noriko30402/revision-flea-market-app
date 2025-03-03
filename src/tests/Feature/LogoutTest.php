<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class LogoutTest extends TestCase
{
    /**
     * ログイン後にログアウトできるかどうかのテスト
     *
     * @return void
     */
    public function test_user_can_logout()
    {
        Mail::fake();
        // 1. ユーザーにログインをする
        $user = User::factory()->create([
            'email' => 'test'.time().'@example.com',  // ユニークなメールアドレスを生成
            'password' => bcrypt('password123'),
        ]);

        // ユーザーでログイン
        $this->actingAs($user);

        // 2. ログアウトボタンを押す
        $response = $this->post('/logout');  // ログアウトURLにPOSTリクエストを送信

        // 3. ログアウト処理が実行されることを確認
        $response->assertRedirect('/');  // ログアウト後、リダイレクト先（例えばホームページ）にリダイレクトされることを確認

        // ユーザーが認証されていないことを確認
        $this->assertGuest();  // ログアウト後にユーザーがゲスト状態であることを確認
    }
}
