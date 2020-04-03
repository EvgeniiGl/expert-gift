<?php

/**
 * @param $response array (optional) [
 *      ["status"] boolean (default true),
 *      ["code"]  int (default 0),
 *      ["message"] string (default 'OK'),
 *      ["data"] array (default null),
 * ]
 * @param int $code
 * @return \Illuminate\Http\JsonResponse
 */
function successResponse($response = [], $code = 200)
{
    $data = [
        "status"  => $response['status'] ?? true,
        "code"    => $response['code'] ?? 0,
        "message" => $response['message'] ?? "OK",
        "data"    => $response['data'] ?? null
    ];

    //TODO rewrite with response helper
    return response()->json($data, $code);
}

/**
 * @param $response array (optional) [
 *      ["status"] boolean (default false),
 *      ["code"]  int (default 0),
 *      ["message"] string (default 'Ошибка сервера'),
 * ]
 * @param int $code
 * @return \Illuminate\Http\JsonResponse
 */
function errorResponse($response = [], $code = 404)
{
    $data = [
        "status"  => $response['status'] ?? false,
        "code"    => $response['code'] ?? 0,
        "message" => $response['message'] ?? "Ошибка сервера"
    ];

    //TODO rewrite with response helper
    return response()->json($data, $code);
}

