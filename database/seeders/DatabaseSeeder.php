<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        
        // 生成10筆post假資料
        \App\Models\Post::factory(10)->create();
        
        \App\Models\Catagory::factory(5)->create();
    }
}
