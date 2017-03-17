<?php

use Illuminate\Database\Seeder;

use Conner\Tagging\Contracts\TaggingUtility;
class InitTableSeeder extends Seeder
{
    protected $taggingUtility;
    public function __construct(TaggingUtility $taggingUtility)
    {
        $this->taggingUtility = $taggingUtility;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            '界面' ,
            '动态' ,
            '图标' ,
            '壁纸',
            '其他',
            '设计漫谈',
            '优文私藏',
            '不负时光',
            '灵感创意',
            '摄影图库',
            '设计团队',
            '设计工具',
            '资源素材',
            '经验教程',
        ];

        foreach ($tags as $tag) {
            $tagModel = new \Conner\Tagging\Model\Tag();
            $tagModel->name = $tag;
            $tagModel->slug =  $this->taggingUtility->slug($tag);
            $tagModel->save();
        }

        $tagGroups = [
            'blog','works','share'
        ];
        foreach ($tagGroups as $tagGroup) {
            $group_name = $tagGroup;
            $tag_group = new \Conner\Tagging\Model\TagGroup();
            $tag_group->name = $group_name;
            $tag_group->slug = $this->taggingUtility->slug($group_name);
            $tag_group->save();
        }

    }
}
