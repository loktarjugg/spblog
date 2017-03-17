<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/8
 * Time: 11:13
 */

namespace App\Services;

use Spatie\Fractalistic\ArraySerializer;

class DataArraySerializer extends ArraySerializer
{
    public function collection($resourceKey, array $data)
    {
        if ($resourceKey === false) {
            return $data;
        }
        return array($resourceKey ?: 'data' => $data);
    }

    public function item($resourceKey, array $data)
    {
        if ($resourceKey === false) {
            return $data;
        }
        return array($resourceKey ?: 'data' => $data);
    }
}