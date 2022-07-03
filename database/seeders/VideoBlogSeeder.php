<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\VideoBlog;
use Illuminate\Database\Seeder;

class VideoBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoBlog::factory()->count(50)->createOne();
    }
}
