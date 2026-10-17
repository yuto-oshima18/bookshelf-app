<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewLikeSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = range(1, 5);

        $reviews = Review::all();

        foreach ($reviews as $review) {
            // レビュー投稿者本人を除外
            $availableUserIds = array_values(
                array_diff($userIds, [$review->user_id])
            );

            // いいね人数を0〜3人からランダムに決定
            $likeCount = fake()->numberBetween(0, 3);

            // いいねするユーザーを重複なしで選択
            $likeUserIds = fake()->randomElements(
                $availableUserIds,
                $likeCount
            );

            // いいねを登録（既存の関連データは維持）
            $review->likedReviews()->syncWithoutDetaching($likeUserIds);
        }
    }
}
