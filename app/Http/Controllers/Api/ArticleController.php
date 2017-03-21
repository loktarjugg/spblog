<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Reply;
use App\Repositories\ArticleRepository;
use App\Transformers\ArticleTransformer;
use App\Transformers\ReplyTransformer;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{

    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        @parent::__construct();

        $this->middleware(['auth:api' , 'admin'])->only('store','update','destroy');

        $this->middleware(['cors'])->only('index','show','replies');

        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepository->lists();

        return $this->respond($articles , new ArticleTransformer);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array  = [100,200,9,8,11,23,99,22,33,20,109,555,333,222,2,6,5,4];

        dd(static::quickSort($array));
    }

    private static function quickSort($array = [])
    {
        $length = count($array);
        if ( $length <= 1){
            return $array;
        }

        $element = $array[0];

        $left = $right = [];

        for ($i = 1; $i < $length ; $i++ ){

            if ($element > $array[$i]){
                $left[] = $array[$i];
            }else{
                $right[] = $array[$i];
            }
        }
        $left = static::quickSort($left);

        $right = static::quickSort($right);


        return array_merge($left ,  [$element] , $right );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $this->articleRepository->store($request->except('_token','_url'));

        return $this->nullRespond();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $articles = $this->articleRepository->findBySlug($slug);

        return $this->respond($articles , new ArticleTransformer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function replies($slug)
    {
        $replies = $this->articleRepository->getReplies($slug);

        return $this->respond($replies , new ReplyTransformer);
    }
}
