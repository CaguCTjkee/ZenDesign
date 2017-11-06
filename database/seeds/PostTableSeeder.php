<?php

use Illuminate\Database\Seeder;
use \App\Post;
use \App\Tag;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Post 1
        $post = new Post();
        $post->title = 'Desire to making design is what wakes me up every morning';
        $post->alias = 'desire_to_making_design';
        $post->intro = '<p>My passion lies in design of user interfaces, so I’m designer-maniac
with strong coding skills. I believe what it’s my advantage
because I understand full process and I have rich experience
in collaborating with other designers and frontend developers.</p>';
        $post->content = '<p>My passion lies in design of user interfaces, so I’m designer-maniac
with strong coding skills. I believe what it’s my advantage
because I understand full process and I have rich experience
in collaborating with other designers and frontend developers.</p>';
        $post->read_more = 'Read more';
        $post->views = 0;
        $post->status = 'Publish';
        $post->save();
        $post->tags()->attach(Tag::where('alias', 'design')->first());

        // Post 2
        $post = new Post();
        $post->title = 'Desire to making design is what wakes me up every morning';
        $post->alias = 'desire_to_making_design_2';
        $post->intro = '<p>My passion lies in design of user interfaces, so I’m designer-maniac
with strong coding skills. I believe what it’s my advantage
because I understand full process and I have rich experience
in collaborating with other designers and frontend developers.</p>';
        $post->content = '<p>My passion lies in design of user interfaces, so I’m designer-maniac
with strong coding skills. I believe what it’s my advantage
because I understand full process and I have rich experience
in collaborating with other designers and frontend developers.</p>';
        $post->read_more = 'Read more';
        $post->views = 0;
        $post->status = 'Publish';
        $post->save();
        $post->tags()->attach(Tag::where('alias', 'develop')->first());

        // Post 3
        $post = new Post();
        $post->title = 'Desire to making design is what wakes me up every morning';
        $post->alias = 'desire_to_making_design_3';
        $post->intro = '<p>My passion lies in design of user interfaces, so I’m designer-maniac
with strong coding skills. I believe what it’s my advantage
because I understand full process and I have rich experience
in collaborating with other designers and frontend developers.</p>';
        $post->content = '<p>My passion lies in design of user interfaces, so I’m designer-maniac
with strong coding skills. I believe what it’s my advantage
because I understand full process and I have rich experience
in collaborating with other designers and frontend developers.</p>';
        $post->read_more = 'Read more';
        $post->views = 0;
        $post->status = 'Publish';
        $post->save();
        $post->tags()->attach(Tag::where('alias', 'develop')->first());
        $post->tags()->attach(Tag::where('alias', 'design')->first());
    }
}
