<?php

namespace App\Http\Controllers;

use App\Services\FileRegisterService;
use Illuminate\Http\Request;

class FileRegisterController extends Controller
{
    public function __construct(protected FileRegisterService $fileRegisterService) {}
    public function index()
    {
        return $this->fileRegisterService->index();
    }

    public function show($id)
    {
        return $this->fileRegisterService->show($id);
    }
}
