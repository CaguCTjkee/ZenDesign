<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new \App\Tag();
        $tag->title = 'Design';
        $tag->alias = 'design';
        $tag->save();

        $tag = new \App\Tag();
        $tag->title = 'Develop';
        $tag->alias = 'develop';
        $tag->save();
    }
}
