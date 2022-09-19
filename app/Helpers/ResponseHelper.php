<?php


namespace App\Helpers;


use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    /**
     * @param mixed $data
     * @param string|null $message
     * @param int|null $status
     * @return JsonResponse
     */
    public function success(mixed $data = null, ?string $message = null, ?int $status = null) : JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data ?? []
        ], $status ?? 200,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param mixed $messages
     * @param int|null $status
     * @return JsonResponse
     */
    public function error($messages, ?int $status = null) : JsonResponse
    {
        return response()->json([
            'messages' => $messages,
        ], $status ?? 400,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}

