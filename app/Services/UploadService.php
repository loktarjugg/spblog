<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/17
 * Time: 09:59
 */

namespace App\Services;


class UploadService
{
    protected $disk;

    public function __construct()
    {
        $this->disk = \Storage::disk(config('filesystems.default'));
    }

    public function upload($fileName , $content)
    {
        return $this->disk->put($fileName , $content);
    }

    public function exists($fileName)
    {
        return $this->disk->exists($fileName);
    }

    public function getUrl($fileName)
    {
        return $this->disk->url($fileName);
    }
}