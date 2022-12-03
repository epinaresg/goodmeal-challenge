<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Requests\Api\App\CreateAddressRequest;
use App\UseCases\Api\App\SaveAddressUseCase;
use Illuminate\Http\JsonResponse;

class SaveAddressController
{
    public function __invoke(CreateAddressRequest $request): JsonResponse
    {
        (new SaveAddressUseCase())->__invoke($request->validated());

        return response()->json([], JsonResponse::HTTP_CREATED);
    }
}
