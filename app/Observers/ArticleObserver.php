<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/16
 * Time: 15:21
 */

namespace App\Observers;


use App\Models\Article;
use App\Services\QiniuUpload;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ArticleObserver
{
    public function saving(Article $article)
    {
        if (! $article->slug){
            $article->slug = translug($article->title);
        }
    }

    public function saved(Article $article)
    {
        if (! $article->qrcode){
            $qrcode = QrCode::format('png')
                    ->size(400)
                    ->generate(url('article',[$article->slug]));

            $fileName = md5(uniqid()) . '.png';
            $disk = new QiniuUpload();
            $disk->put($fileName , $qrcode);

            $article->qrcode = $disk->getUrl($fileName);
            $article->save();
        }

    }
}