<?php

namespace App\Http\Controllers\Api;

use App\Services\DataArraySerializer;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function __construct()
    {
        //do something ...
    }
    
    public function respond($data , $callback , $statusCode = 200 , $headers = [])
    {
        $manager = fractal($data, $callback)
            ->serializeWith(new DataArraySerializer());

        if (\Request::has('include')){
            $manager->parseIncludes(\Request::get('include'));
        }

        return $manager->respond(200 , $headers);
    }

    public function nullRespond()
    {
        return new JsonResponse([] , 204);
    }

    public function errorRespond($message = '' , $status = 400)
    {
        return new JsonResponse($message , $status);
    }

    public function generalRespond($data , $status = 200)
    {
        return new JsonResponse([
            'data' => $data
        ], $status);
    }
}
