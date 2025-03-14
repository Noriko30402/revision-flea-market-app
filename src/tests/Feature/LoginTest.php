<?php

namespace Tests\Feature;

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
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'password123',
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
    $response = $this->post('/login', [
        'email' => 'invalid@example.com',
        'password' => 'wrongpassword',
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
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/');

    $this->assertAuthenticatedAs($user);
}
}
