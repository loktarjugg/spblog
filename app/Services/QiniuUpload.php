<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/17
 * Time: 10:03
 */

namespace App\Services;


/**
 * Class QiniuUpload
 * @package App\Services
 */
class QiniuUpload
{
    /**
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    protected $disk;

    /**
     * QiniuUpload constructor.
     */
    public function __construct()
    {
        $this->disk = \Storage::disk(config('filesystems.qiniu'));
    }

    /**
     * @param string $fileName
     * @param $content
     * @return bool
     */
    public function put($fileName = '' , $content)
    {
        return $this->disk->put($fileName , $content);
    }

    /**
     * @param $fileName
     * @return bool
     */
    public function exists($fileName)
    {
        return $this->disk->exists($fileName);
    }

    /**
     * @param $fileName
     * @return mixed
     */
    public function getUrl($fileName)
    {
        return $this->disk->getDriver()->imagePreviewUrl($fileName);
    }
}