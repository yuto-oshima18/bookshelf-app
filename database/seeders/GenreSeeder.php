<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        // 追加したいジャンル情報を配列で準備
        $genres = [
            ['name' => '小説'],
            ['name' => 'ビジネス'],
            ['name' => '技術書'],
            ['name' => '自己啓発'],
            ['name' => 'エッセイ'],
            ['name' => '歴史'],
            ['name' => '科学'],
            ['name' => '芸術'],
            ['name' => '料理'],
            ['name' => '旅行'],
        ];

        foreach ($genres as $genre) {
            // name が重複しているか検索し、なければ新規作成
            Genre::firstOrCreate(
                ['name' => $genre['name']],          // 検索条件
                [
                    'name' => $genre['name'],          // 作成時に必要な値
                ]
            );
        }
    }
}
