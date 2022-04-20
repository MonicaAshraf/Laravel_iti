<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Database\Factories\PostsTableFactory;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Models\Post::class,500)->create(); Not work

        PostsTableFactory::times(500)->create();
        //Post::factory()->count(500)->create();
    }
}
