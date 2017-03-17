<?php

namespace App\Http\Controllers\Api;

use App\Services\QiniuUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends ApiController
{

    protected $disk;

    public function __construct(QiniuUpload $qiniuUpload)
    {
        $this->disk = $qiniuUpload;
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        $file = $this->disk->put('' , $file);

        if (! $this->disk->exists($file)){
            return $this->errorRespond('The file upload error');
        }

        return response()->json([
            'path' =>$this->disk->getUrl($file)
        ]);

    }
}
