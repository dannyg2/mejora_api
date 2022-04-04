<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

trait ApiResponser
{

    private function successResponse( $data, $code )
    {
        return response()->json(
            [
                'status'   => 'ok',
                'code'     => $code,
                'messages' => [],
                'result'   => $data,
            ], $code);
    }

    protected function errorResponse( $message, $code )
    {
        return response()->json(
            [
                'status'   => 'error',
                'code'     => $code,
                'messages' => $message,
                'result'   => [],
            ], $code);
    }

    protected function showData( $collection, $code = 200 )
    {
        return $this->successResponse($collection, $code);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function isCleanChange(): \Illuminate\Http\JsonResponse
    {
        return $this->errorResponse("Debe realizar un cambio", 400);
    }

    protected function registerLog( string $message, string $type = 'info', array $data = [] )
    {
        Log::channel('api')->$type($message, $data);
    }

}
