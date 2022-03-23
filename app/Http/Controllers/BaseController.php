<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class BaseController extends Controller
{
    /**
     * Returns the logged user.
     *
     * @return \App\Models\User
     */
    protected function user()
    {
        return auth()->user();
    }

    /**
     * Returns default response.
     *
     * @param mixed $message
     * @param mixed $data
     * @param mixed $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($message, $data = [], $statusCode = Response::HTTP_OK)
    {
        $response = [
            'status'  => $statusCode,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Returns successfull response.
     *
     * @param mixed $message
     * @param mixed $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseOk($message, $data = [])
    {
        return $this->response($message, $data, Response::HTTP_OK);
    }

    /**
     * Returns error response.
     *
     * @param mixed $message
     * @param mixed $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseCreated($message, $data = [])
    {
        return $this->response($message, $data, Response::HTTP_CREATED);
    }

    /**
     * Returns the not found response.
     *
     * @param mixed $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseNotFound($message)
    {
        return $this->response($message, [], Response::HTTP_NOT_FOUND);
    }

    /**
     * Returns error response.
     *
     * @param mixed $message
     * @param mixed $data
     * @param mixed $statusCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseError($message, $data = [], $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return $this->response($message, $data, $statusCode);
    }
}
