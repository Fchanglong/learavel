<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tops;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 一键调用其他类  php artisan db:seed
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        Tops::factory(50)->create();
    }
}
