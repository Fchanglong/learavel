<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        // 截断整个表，这将从表中删除所有记录并将自动递增 ID 重置为零，您可以使用 truncate
        Article::truncate();

        //运用 Faker 库可以快速为我们生成格式正确的测试数据:
        // https://github.com/fzaninotto/Faker
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Article::create([
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
            ]);
        }
    }
}
