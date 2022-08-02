<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * builds the response
     *
     * @param string|array $data
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Build a valid response
     * @param  string|array $data
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function validResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * buids the error response 
     *
     * @param string¬array $message
     * @param int $code
     * @return void
     */
    public function errorsResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

        /**
     * buids the error response in json format
     *
     * @param string¬array $message
     * @param int $code
     * @return void
     */
    public function errorsMessage($message, $code)
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}