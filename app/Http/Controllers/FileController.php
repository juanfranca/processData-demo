<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;



class FileController extends Controller
{
    public function __construct(protected FileService $fileService) {}

    public function index(): JsonResponse
    {
        return $this->fileService->index();
    }

    public function show($id): JsonResponse
    {
        return $this->fileService->show($id);
    }

    public function create(FileRequest $request): JsonResponse
    {
        return $this->fileService->create($request);
    }

    public function delete($id): JsonResponse
    {
        return $this->fileService->delete($id);
    }

    public function processFile($id): JsonResponse
    {
        return $this->fileService->processFile($id);
    }
}
