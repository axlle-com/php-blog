<?php

namespace Main\User\Http;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Main\Analytic\Service\RequestLogger;
use Symfony\Component\HttpFoundation\Response;

class GetUser extends Controller
{
    public function __construct(private readonly RequestLogger $requestLogger)
    {
    }

    public function __invoke(): JsonResponse|JsonResource
    {
        return new JsonResponse([], Response::HTTP_OK);
    }
}
