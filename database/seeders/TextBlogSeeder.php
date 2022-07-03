<?php

namespace Database\Seeders;

use App\Models\TextBlog;
use Illuminate\Database\Seeder;

class TextBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TextBlog::factory()->count(50)->create();
    }
}
