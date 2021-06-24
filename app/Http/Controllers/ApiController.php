<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Exception;

class ApiController extends Controller
{
    protected const SUCCESS_CODE = 1;
    protected const ERROR_CODE = 0;

    /**
     * @param string $message
     * @param array $data
     * @return JsonResponse
     */
    protected function successResponse(string $message = '', array $data = []): JsonResponse
    {
        return response()->json([
            'success' => self::SUCCESS_CODE,
            'data' => $data,
            'message' => $message
        ], Response::HTTP_OK);
    }

    /**
     * @param Exception $exception
     * @param string|null $message
     * @param array $data
     * @return JsonResponse
     */
    protected function errorResponse(Exception $exception, string $message = null, array $data = []): JsonResponse
    {
        return response()->json([
            'success' => self::ERROR_CODE,
            'data' => $data,
            'message' => $message ? $message : $exception->getMessage()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param array $payload
     * @return JsonResponse
     */
    protected function createdResponse(array $payload = []): JsonResponse
    {
        return response()->json([
            'success' => self::SUCCESS_CODE,
            'payload' => $payload,
            'message' => 'Dane zostały zapisane'
        ], Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function deletedResponse(): JsonResponse
    {
        return response()->json([
            'success' => self::SUCCESS_CODE,
            'message' => 'Dane zostały usunięte'
        ], Response::HTTP_OK);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function noFoundResponse(string $message = 'Strona nie istnieje'): JsonResponse
    {
        return response()->json([
            'success' => self::ERROR_CODE,
            'message' => $message
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function badResponse(string $message): JsonResponse
    {
        return response()->json([
            'success' => self::ERROR_CODE,
            'message' => $message
        ]);
    }
}
