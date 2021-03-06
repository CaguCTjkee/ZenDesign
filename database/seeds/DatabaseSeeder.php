<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Posts and tags
        $this->call(TagTableSeeder::class);
        $this->call(PostTableSeeder::class);
    }
}
