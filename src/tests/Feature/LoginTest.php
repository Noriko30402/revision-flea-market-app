<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use APP\Models\User;
use Illuminate\Support\Facades\Mail;


class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_email_is_required_for_login()
    {
        // ログインフォームにメールアドレスなしでPOSTリクエストを送信
        $response = $this->post('/login', [
            'email' => '',  // メールアドレスを空にする
            'password' => 'password123',  // パスワードは入力
        ]);
        $errors = session('errors');
        $this->assertEquals('メールアドレスを入力してください', $errors->first('email'));
    }

        /**
     * パスワードが入力されていない場合のテスト
     *
     * @return void
     */
    public function test_password_is_required_for_login()
    {
        // パスワードなしで登録リクエストを送信
        $response = $this->post('/login', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $errors = session('errors');
        $this->assertEquals('パスワードを入力してください', $errors->first('password'));
    }
/**
 * ログイン情報が間違っている場合、バリデーションメッセージが表示されるテスト
 *
 * @return void
 */
public function test_login_with_invalid_credentials()
{
    // 存在しないメールアドレスと間違ったパスワードでログインリクエストを送信
    $response = $this->post('/login', [
        'email' => 'invalid@example.com',  // 存在しないメールアドレス
        'password' => 'wrongpassword',     // 誤ったパスワード
    ]);

    $errors = session('errors');
    $this->assertEquals('ログイン情報が登録されていません。', $errors->first('email'));

}

/**
 * 正しい情報が入力された場合、ログイン処理が実行されるテスト
 *
 * @return void
 */
public function test_login_with_correct_credentials()
{
    Mail::fake();
    // テスト用のユーザーを作成
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    // 正しいメールアドレスとパスワードでログインリクエストを送信
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    // ログインが成功した場合、ホームページやダッシュボードなどにリダイレクトされることを確認
    $response->assertRedirect('/');  // ホームページ（または適切なリダイレクト先）にリダイレクトされることを確認

    // ログイン後にユーザーが認証された状態であることを確認
    $this->assertAuthenticatedAs($user);
}
}
