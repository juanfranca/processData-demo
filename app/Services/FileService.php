<?php

namespace App\Services;
use App\Models\File;
use App\Traits\ResponseJson;


class FileService
{
  use ResponseJson;


  public function index()
  {
    return $this->successResponse('Success in retrieving all files!', File::with('user')->get());
  }

  public function show($id)
  {
    $file = File::with('user')->find($id);

    if (!$file) {
      return $this->errorResponse('This File does not exist.', 404);
    }

    return $this->successResponse('Success in retrieving the file!', $file);
  }
/*
private function chunkDados($Dados, $totalDados, $chunkSize)
  {
    $data = '';
    $emp = null;

    for ($ii = 0; $ii < $TotalArray; $ii++) {

      if (!$emp) {
        $emp = $this->getId($dados[$ii]['cnpjEmpresa']);
      }

      $lancamento = $this->monta($dados[$ii], $emp);
      $data .= $lancamento;

      if ($ii != 0 && $ii % $chunkSize === 0) {
        yield $data;
        $data = '';
      }
    }

    if (!empty($data)) {
      yield $data;
    }


  }
*/

}