<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 追加したいユーザ情報を配列で準備
        $users = [
            ['name' => '山田太郎', 'email' => 'yamada@example.com', 'password' => 'password'],
            ['name' => '鈴木花子', 'email' => 'suzuki@example.com', 'password' => 'password'],
            ['name' => '田中一郎', 'email' => 'tanaka@example.com', 'password' => 'password'],
            ['name' => '佐藤美咲', 'email' => 'sato@example.com', 'password' => 'password'],
            ['name' => '高橋健太', 'email' => 'takahashi@example.com', 'password' => 'password'],
        ];

        foreach ($users as $user) {
            // email が重複しているか検索し、なければ新規作成
            User::firstOrCreate(
                ['email' => $user['email']],          // 検索条件
                [
                    'name' => $user['name'],          // 作成時に必要な値
                    'password' => Hash::make($user['password']), // パスワードはハッシュ化
                ]
            );
        }
    }
}
