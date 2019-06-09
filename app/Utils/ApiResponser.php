<?php

namespace App\Utils;

use Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        $collection = $this->cacheResponse($collection);
        return $this->successResponse(['data' => $collection], $code);
    }

    protected function showOne(Model $model, $code = 200)
    {
        return $this->successResponse(['data' => $model], $code);
    }

    protected function cacheResponse($data)
    {
        $url = request()->url();

        $queryParams = request()->query();
        ksort($queryParams);
        $queryString = http_build_query($queryParams);
        $fullUrl = "{$url}?{$queryString}";

        return Cache::remember($fullUrl, 30 / 60, function () use ($data) {
            return $data;
        });
    }
}
