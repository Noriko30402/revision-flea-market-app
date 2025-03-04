<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Database\Seeders\ItemsTableSeeder;


class MyListTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザーがログインし、マイリストにいいねした商品が表示されるかテスト
     *
     * @return void
     */
    // public function test_user_can_see_liked_products_in_my_list()
    // {
    //     Mail::fake();

    //     Mail::fake();
    //     $user = User::factory()->create([
    //         'email' => 'test@example.com',
    //         'password' => bcrypt('password123'),
    //     ]);

    //     $response = $this->post('/login', [
    //         'email' => 'test@example.com',
    //         'password' => 'password123',
    //     ]);
    //     $response->assertRedirect('/');
    //     $this->assertAuthenticatedAs($user);

    //     $item1 = Item::where('item_name', '腕時計')->first();
    //     $item2 = Item::where('item_name', 'HDD')->first();

    //     $user->favorite([
    //         'item_id' => $item1->id,
    //     ]);

    //     $response = $this->actingAs($user);

    //     $response = $this->get(route('index'));

    //     $response->assertStatus(200);
    //     $response->assertSee($item1->name);
    //     $response->assertDontSee($item2->name);
    // }
}
