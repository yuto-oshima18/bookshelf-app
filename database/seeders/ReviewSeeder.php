<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $bookIds = range(1, 11);
        $userIds = range(1, 5);
        $reviewCounts = [];

        // 各書籍に2〜4件のレビューをランダムに配分
        foreach ($bookIds as $bookId) {
            $reviewCounts[$bookId] = fake()->numberBetween(2, 4);
        }

        // 合計32件になるように調整
        while (array_sum($reviewCounts) !== 32) {
            $bookId = fake()->randomElement($bookIds);

            if (array_sum($reviewCounts) < 32) {
                if ($reviewCounts[$bookId] < 4) {
                    $reviewCounts[$bookId]++;
                }
            } else {
                if ($reviewCounts[$bookId] > 2) {
                    $reviewCounts[$bookId]--;
                }
            }
        }

        // 5人全員が最低1件投稿するようにする
        $usedUserIds = [];

        foreach ($reviewCounts as $bookId => $count) {
            for ($i = 0; $i < $count; $i++) {
                $availableUserIds = array_values(
                    array_diff($userIds, $usedUserIds)
                );

                $userId = !empty($availableUserIds)
                    ? fake()->randomElement($availableUserIds)
                    : fake()->randomElement($userIds);

                $usedUserIds[] = $userId;

                // Factoryでratingとcommentを生成
                $reviewData = Review::factory()->make()->toArray();

                // create()でレビューを登録
                Review::create(array_merge($reviewData, [
                    'book_id' => $bookId,
                    'user_id' => $userId,
                ]));
            }
        }
    }
}
