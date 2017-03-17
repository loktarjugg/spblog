<?php

use Illuminate\Database\Seeder;

class WorkTableSeeder extends Seeder
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
                    '界面' , '动态' ,'图标' ,
                    '壁纸','其他'
                ]);
                $article->tag($tags->random(rand(1,3))->toArray());

                foreach($article->tags as $tag) {
                    $tag->setGroup('works');
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
