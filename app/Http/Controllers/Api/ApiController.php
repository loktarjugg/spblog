<?php

namespace App\Http\Controllers\Api;

use App\Services\DataArraySerializer;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiController
 * @package App\Http\Controllers\Api
 */
class ApiController extends Controller
{
    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        //do something ...
    }

    /**
     * @param $data
     * @param $callback
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    public function respond($data, $callback, $statusCode = 200, $headers = [])
    {
        $manager = fractal($data, $callback)
            ->serializeWith(new DataArraySerializer());

        if (\Request::has('include')) {
            $manager->parseIncludes(\Request::get('include'));
        }

        return $manager->respond($statusCode, $headers);
    }

    /**
     * @return JsonResponse
     */
    public function nullRespond()
    {
        return new JsonResponse([], 204);
    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function errorRespond($message = '', $status = 400)
    {
        return new JsonResponse($message, $status);
    }

    /**
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    public function generalRespond($data, $status = 200)
    {
        return new JsonResponse([
            'data' => $data
        ], $status);
    }
}
