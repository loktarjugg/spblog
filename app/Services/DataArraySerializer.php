<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/8
 * Time: 11:13
 */

namespace App\Services;

use Spatie\Fractalistic\ArraySerializer;

/**
 * Class DataArraySerializer
 * @package App\Services
 */
class DataArraySerializer extends ArraySerializer
{
    /**
     * @param string $resourceKey
     * @param array $data
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        if ($resourceKey === false) {
            return $data;
        }
        return array($resourceKey ?: 'data' => $data);
    }

    /**
     * @param string $resourceKey
     * @param array $data
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        if ($resourceKey === false) {
            return $data;
        }
        return array($resourceKey ?: 'data' => $data);
    }
}