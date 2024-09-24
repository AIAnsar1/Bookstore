<?php

namespace App\Dtos;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as Status;

class ApiResponse
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public static function Success(array $data): JsonResponse
    {
        return Response::json([
            "data" => $data,
            "success" => true,
        ], Status::HTTP_OK);
    }


    /**
     * @param string $message
     * @param int $status
     * @param bool $isArray
     * @return JsonResponse
     */
    public static function Error(string $message, int $status = Status::HTTP_OK, bool $isArray = false): JsonResponse
    {
        if ($isArray)
        {
            $message = reset($message)[0];
        }

        return Response::json([
            "message" => $message,
            "success" => false,
        ], $status);
    }
}
