<?php

namespace App\Http\Controllers\Api\Backoffice\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Backoffice\Store\CreateStoreRequest;
use App\UseCases\CreateStoreUseCase;
use Illuminate\Http\JsonResponse;

class CreateStoreController extends Controller
{
    private $useCase;
    public function __construct(CreateStoreUseCase $createStore)
    {
        $this->useCase = $createStore;
    }

    public function __invoke(CreateStoreRequest $request): JsonResponse
    {
        try {
            $this->useCase->__invoke($request->validated());
            return response()->json([], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
