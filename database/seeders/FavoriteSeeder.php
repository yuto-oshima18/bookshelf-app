<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = range(1, 5);
        $bookIds = range(1, 11);

        foreach ($userIds as $userId) {
            // お気に入りの書籍数を3〜5冊からランダムに決定
            $favoriteCount = fake()->numberBetween(3, 5);

            // 書籍IDを重複なしでランダムに選択
            $favoriteBookIds = fake()
                ->randomElements($bookIds, $favoriteCount);

            // お気に入りを登録（既存の関連データは維持）
            User::findOrFail($userId)
                ->favoriteBooks()
                ->syncWithoutDetaching($favoriteBookIds);
        }
    }
}
