<?php

namespace Yudhi\Apigen\Types;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;
use Yudhi\Apigen\Enums\HttpCodeEnum;

trait ResponseManager
{
    /**
     * Return a new response from the application.
     *
     * @return ($content is null ? ResponseFactory : Response)
     *
     * @throws BindingResolutionException
     */
    private function response(View|array|string|null $content = null, int $status = 200, array $headers = []): Response|ResponseFactory
    {
        $factory = app(ResponseFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($content ?? '', $status, $headers);
    }

    /**
     * @throws BindingResolutionException
     */
    private function successResponse(array $data): JsonResponse
    {
        return $this->response()->json([
            'message' => 'Success',
            'data' => $data,
        ]);
    }

    /**
     * @throws BindingResolutionException
     */
    private function createdResponse(array $data): JsonResponse
    {
        return $this->response()->json([
            'message' => 'Created',
            'data' => $data,
        ], 201);
    }

    /**
     * @throws BindingResolutionException
     */
    private function errorResponse(Throwable $throwable, HttpCodeEnum $code): JsonResponse
    {
        return match ($code) {
            HttpCodeEnum::NOT_FOUND => $this->response()->json([
                'message' => 'Not Found Data',
            ]),
            default => $this->response()->json([
                'message' => 'Please Contact Administrator',
            ], $code->name),
        };
    }
}
