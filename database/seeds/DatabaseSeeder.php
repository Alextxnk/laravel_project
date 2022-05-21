<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 4)->create(); // создаем с помощью seeder 4 пользователя
        factory(\App\Post::class, 150)->create(); // создаем с помощью seeder 15 постов
    }
}
