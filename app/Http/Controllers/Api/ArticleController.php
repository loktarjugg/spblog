<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Reply;
use App\Repositories\ArticleRepository;
use App\Transformers\ArticleTransformer;
use App\Transformers\ReplyTransformer;
use Illuminate\Http\Request;
use Translug;

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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {

//        return $this->generalRespond($request->all());
        $this->articleRepository->update($request->all() , $slug);

        return $this->nullRespond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $this->articleRepository->destroy($slug);

        return $this->nullRespond();
    }

    public function replies($slug)
    {
        $replies = $this->articleRepository->getReplies($slug);

        return $this->respond($replies , new ReplyTransformer);
    }
}
