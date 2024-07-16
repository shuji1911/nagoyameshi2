<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $user = new User();
        $user->name = '侍太郎';
        $user->email = 'taro.samurai@example.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->postal_code = '1010022';
        $user->address = '東京都千代田区神田練塀町300番地 住友不動産秋葉原駅前ビル5F';
        $user->phone_number = '0000000000';
        $user->save();

        $user = new User();
        $user->name = '侍次郎';
        $user->email = 'jiro.samurai@example.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->postal_code = '1010022';
        $user->address = '東京都千代田区神田練塀町300番地 住友不動産秋葉原駅前ビル5F';
        $user->phone_number = '0000000000';
        $user->save();

        User::factory()->count(10)->create();
    }
}
