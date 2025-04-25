<?php

namespace App\Http\Controllers;

use App\Services\AuditFileService;
use Illuminate\Http\Request;

class AuditFileController extends Controller
{
    public function __construct(protected AuditFileService $auditFileService) {}
    public function index() {
        return $this->auditFileService->index();
    }

    public function show($id) {
        return $this->auditFileService->show($id);
    }
}
