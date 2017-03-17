<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\UrlGenerator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $realName  = date("Y-m-d",time()) .'/'. $file->getClientOriginalName();

        $fileName = str_random(10).'.'.$extension;

        $disk = \Storage::disk('local');

        $realPath = $file->getRealPath();

        if(!isset($realPath)){
            $json = response()->json(['code'=>102,'message'=>'上传失败,没有找到该文件']);
            return $json;
        }
        $files = file_get_contents($realPath);

        if(!$files){
            $json = response()->json(['code'=>103,'message'=>'上传失败,读取该文件失败']);
            return $json;
        }
        $fileName =date("Y-m-d",time()).'/'.$fileName;

        $disk->put($fileName,$files);

        if(!$disk->exists($fileName)){
            $json = response()->json(['code'=>104,'message'=>'保存失败,请联系系统管理员']);
            return $json;
        }
        $json = response()->json(['code'=>200,'result'=>['savePath'=>$fileName,'realName'=>$realName]]);
        return $json;
    }
}
