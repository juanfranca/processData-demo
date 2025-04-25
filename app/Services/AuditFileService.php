<?php

namespace App\Services;

use App\Http\Resources\AuditFileResource;
use App\Models\AuditFile;
use App\Traits\ResponseJson;
use Illuminate\Http\JsonResponse;


class AuditFileService
{
    use ResponseJson;


    public function index(): JsonResponse
    {
        return $this->successResponse('Success in retrieving all log files!', AuditFileResource::collection(AuditFile::with('user')->get()));
    }

    public function show($id): JsonResponse
    {
        $auditFile = AuditFile::with('user')->find($id);

        if (!$auditFile) {
            return $this->errorResponse('This Log does not exist.', 404);
        }

        return $this->successResponse('Success in retrieving the log!', new AuditFileResource($auditFile));
    }
}
