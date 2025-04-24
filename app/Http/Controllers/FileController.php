<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\FileService;


class FileController extends Controller
{
    public function __construct(protected FileService $fileService = new FileService)
    {
    }

    public function index()
    {
        return $this->fileService->index();
    }

    public function show($id)
    {

    }

    public function create(FileRequest $request)
    {
    }

    public function update(FileRequest $request, $id)
    {

    }

    public function delete($id)
    {
    }

    public function processFile()
    {

    }
}
