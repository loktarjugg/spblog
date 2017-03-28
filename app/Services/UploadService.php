<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/17
 * Time: 09:59
 */

namespace App\Services;


/**
 * Class UploadService
 * @package App\Services
 */
class UploadService
{
    /**
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    protected $disk;

    /**
     * UploadService constructor.
     */
    public function __construct()
    {
        $this->disk = \Storage::disk(config('filesystems.default'));
    }

    /**
     * @param $fileName
     * @param $content
     * @return bool
     */
    public function upload($fileName , $content)
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
     * @return string
     */
    public function getUrl($fileName)
    {
        return $this->disk->url($fileName);
    }
}