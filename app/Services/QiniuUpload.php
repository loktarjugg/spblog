<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/17
 * Time: 10:03
 */

namespace App\Services;


class QiniuUpload
{
    protected $disk;

    public function __construct()
    {
        $this->disk = \Storage::disk(config('filesystems.qiniu'));
    }

    public function put($fileName = '' , $content)
    {
        return $this->disk->put($fileName , $content);
    }

    public function exists($fileName)
    {
        return $this->disk->exists($fileName);
    }

    public function getUrl($fileName)
    {
        return $this->disk->getDriver()->imagePreviewUrl($fileName);
    }
}