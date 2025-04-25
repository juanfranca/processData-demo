<?php

namespace App\Services;

use App\Models\FileRegister;
use App\Traits\ResponseJson;
use Illuminate\Http\JsonResponse;

class FileRegisterService
{
    use ResponseJson;
    public function index(): JsonResponse
    {
        return $this->successResponse('Success in retrieving all file registers!', FileRegister::paginate(10)->toArray());
    }
    public function show($id): JsonResponse
    {
        $fileRegister  = FileRegister::find($id);

        if (!$fileRegister) {
            return $this->errorResponse('This File Register does not exist.', 404);
        }

        return $this->successResponse('Success in retrieving the register!', $fileRegister);
    }
}
