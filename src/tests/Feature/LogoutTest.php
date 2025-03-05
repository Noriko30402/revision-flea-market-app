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
        $user = User::factory()->create([
            'email' => 'test'.time().'@example.com',
            'password' => bcrypt('password123'),
        ]);

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');

        $this->assertGuest();
    }
}
