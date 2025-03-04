<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_validation_message_if_name_is_not_provided()
    {
        $response = $this->post('/register', [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $errors = session('errors');
        $this->assertEquals('お名前を入力してください', $errors->first('name'));
    }

    /**
     * メールアドレスが入力されていない場合のテスト
     *
     * @return void
     */
    public function test_email_is_required_for_registration()
    {
        // メールアドレスなしで登録リクエストを送信
        $response = $this->post('/register', [
            'name' => 'John Doe',  // 他の必要なフィールドを記入
            'email' => '',         // メールアドレスは空
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $errors = session('errors');
        $this->assertEquals('メールアドレスを入力してください', $errors->first('email'));
    }

    /**
     * パスワードが入力されていない場合のテスト
     *
     * @return void
     */
    public function test_password_is_required_for_registration()
    {
        // パスワードなしで登録リクエストを送信
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $errors = session('errors');
        $this->assertEquals('パスワードを入力してください', $errors->first('password'));
    }

    /**
     * パスワードが7文字以下の場合のテスト
     *
     * @return void
     */
    public function test_password_is_minimum_8_characters()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'passwor',
            'password_confirmation' => 'passwor',
        ]);

        $errors = session('errors');
        $this->assertEquals('パスワードは8文字以上で入力してください', $errors->first('password'));
    }


    public function test_password_confirmation_is_required_for_registration()
    {
        // パスワードと確認用パスワードが一致しない場合
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password321',
        ]);

        $errors = session('errors');
        $this->assertEquals('パスワードと一致しません', $errors->first('password'));
    }
}


