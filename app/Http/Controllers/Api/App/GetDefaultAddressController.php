<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Resources\Api\App\ShowDefaultAddressResource;
use App\UseCases\Api\App\CalculateStoreDistanceUseCase;
use App\UseCases\Api\App\GetDefaultAddressUseCase;
use Illuminate\Http\JsonResponse;

class GetDefaultAddressController
{
    public function __invoke(): JsonResponse
    {
        $address = (new GetDefaultAddressUseCase())->__invoke();

        if ($address) {
            (new CalculateStoreDistanceUseCase())->__invoke($address);
            return response()->json(new ShowDefaultAddressResource($address), JsonResponse::HTTP_CREATED);
        }

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
