<?php

use Illuminate\Database\Seeder;

class ShareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Share::class, 50)
            ->create()->each(function($share){
                $tags = collect([
                    '灵感创意',
                    '摄影图库',
                    '设计团队',
                    '设计工具',
                    '资源素材',
                    '经验教程'
                ]);
                $share
                    ->tag($tags->random(rand(1,3))->toArray());

                foreach($share->tags as $tag) {
                    $tag->setGroup('share');
                }
            });
    }
}
