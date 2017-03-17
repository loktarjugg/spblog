<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Article::class, 50)
            ->create()->each(function($article){
                $tags = collect([
                    '设计漫谈',
                    '优文私藏',
                    '不负时光'
                ]);
                $article
                    ->tag($tags->random(rand(1,3))->toArray());
                foreach($article->tags as $tag) {
                    $tag->setGroup('blog');
                }

                $article->replies()->create([
                    'user_id' => rand(1,20),
                    'vote_count' => rand(0,100),
                    'body'    => \Faker\Factory::create()->sentences(rand(1,3),true),
                    'body_original'    => \Faker\Factory::create()->sentences(rand(1,3),true)
                ]);
            });
    }
}
