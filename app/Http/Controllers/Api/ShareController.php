<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ShareRequest;
use App\Repositories\ShareRepository;
use App\Transformers\ShareTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShareController extends ApiController
{
    protected $shareRepository;

    public function __construct(ShareRepository $shareRepository)
    {
        @parent::__construct();

        $this->middleware(['auth:api', 'admin'])->only('store', 'update', 'destroy');

        $this->middleware(['cors'])->only('index', 'show');

        $this->shareRepository = $shareRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = $this->shareRepository->lists();

        return $this->respond($lists, new ShareTransformer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShareRequest $request)
    {
        $this->shareRepository->store($request->except('_token','_url'));

        return $this->nullRespond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->shareRepository->destroy($id);

        return $this->nullRespond();
    }
}
