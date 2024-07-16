<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 未ログインのユーザーは管理者側の店舗一覧ページにアクセスできない
     */
    public function test_guests_cannot_access_admin_restaurants_index()
    {
        $response = $this->get(route('admin.restaurants.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * ログイン済みの一般ユーザーは管理者側の店舗一覧ページにアクセスできない
     */
    public function test_regular_user_cannot_access_admin_restaurants_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('admin.restaurants.index'));
        $response->assertForbidden();
    }

    /**
     * ログイン済みの管理者は管理者側の店舗一覧ページにアクセスできる
     */
    public function test_admin_can_access_admin_restaurants_index()
    {
        $admin = User::factory()->admin()->create();
        $this->actingAs($admin);

        $response = $this->get(route('admin.restaurants.index'));
        $response->assertOk();
    }

    /**
     * 以下、他のアクションに対するテストメソッドを追加する
     * show, create, store, edit, update, destroy の各アクションに対するテストを定義する
     */
}
