<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 未ログインのユーザーは管理者側の会員一覧ページにアクセスできない
     */
    public function test_guest_cannot_access_admin_users_index()
    {
        $response = $this->get(route('admin.users.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * ログイン済みの一般ユーザーは管理者側の会員一覧ページにアクセスできない
     */
    public function test_user_cannot_access_admin_users_index()
    {
        // ダミーの一般ユーザーを作成
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.users.index'));
        $response->assertStatus(403); // フォービドゥン (403 Forbidden) を期待
    }

    /**
     * ログイン済みの管理者は管理者側の会員一覧ページにアクセスできる
     */
    public function test_admin_can_access_admin_users_index()
    {
        // ダミーの管理者ユーザーを作成
        $admin = \App\Models\User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('admin.users.index'));
        $response->assertOk(); // HTTP ステータスコード 200 を期待
    }

    /**
     * 未ログインのユーザーは管理者側の会員詳細ページにアクセスできない
     */
    public function test_guest_cannot_access_admin_users_show()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->get(route('admin.users.show', ['user' => $user->id]));
        $response->assertRedirect(route('login'));
    }

    /**
     * ログイン済みの一般ユーザーは管理者側の会員詳細ページにアクセスできない
     */
    public function test_user_cannot_access_admin_users_show()
    {
        $user = \App\Models\User::factory()->create();
        $loggedInUser = \App\Models\User::factory()->create();

        $response = $this->actingAs($loggedInUser)->get(route('admin.users.show', ['user' => $user->id]));
        $response->assertStatus(403); // フォービドゥン (403 Forbidden) を期待
    }

    /**
     * ログイン済みの管理者は管理者側の会員詳細ページにアクセスできる
     */
    public function test_admin_can_access_admin_users_show()
    {
        $admin = \App\Models\User::factory()->admin()->create();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.users.show', ['user' => $user->id]));
        $response->assertOk(); // HTTP ステータスコード 200 を期待
    }
}
