<?php

namespace App\Services;

use App\Enums\FileType;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Models\FileRegister;
use App\Traits\ResponseJson;
use Exception;
use Illuminate\Support\Facades\Storage;

class FileService
{
  use ResponseJson;


  public function index()
  {
    return $this->successResponse('Success in retrieving all files!', FileResource::collection(File::with('user')->get()));
  }

  public function show($id)
  {
    $file = File::with('user')->find($id);

    if (!$file) {
      return $this->errorResponse('This File does not exist.', 404);
    }

    return $this->successResponse('Success in retrieving the file!', new FileResource($file));
  }

  public function create($request)
  {
    try {
      $newFile = $request->all();

      $fileBase64 = base64_decode($newFile['file']);

      if (!$fileBase64) {
        return $this->errorResponse('The file is not in base64.', 400);
      }

      $newFile['file_path'] = $this->saveFile($newFile['file_name'], $newFile['file']);

      $createdFile = File::create($newFile);

      return $this->successResponse('File created successfully!', $createdFile);
    } catch (Exception $e) {

      if (isset($newFile['file_path']) && Storage::disk('local')->exists($newFile['file_path'])) {
        $this->deleteFile($newFile['file_path']);
    }
      return $this->errorResponse($e->getMessage());
    }
  }

  public function delete($id)
  {
    $file = File::find($id);

    if (!$file) {
      return $this->errorResponse('This File does not exist.', 404);
    }

    $file->delete();

    return $this->successResponse('File deleted successfully!');
  }

  public function processFile($id)
  {
    try {

      $file = File::find($id);

      if (!$file) {
        return $this->errorResponse('This File does not exist.', 404);
      }
      $json = $this->getJson($file->file_path);

      $this->processJson($json);

      $file->update(['file_type' => FileType::PROCESSED->value]); 
      
      return $this->successResponse('The records were inserted into the database.');
    } catch (Exception $e) {
      return $this->errorResponse($e->getMessage(), 500);
    }
  }

  private function getJson($filePath)
  {
    if (!Storage::disk('local')->exists($filePath)) {
      return $this->errorResponse('File not found in storage.', 404);
    }

    $fileContent = Storage::disk('local')->get($filePath);

    $jsonContent = json_decode($fileContent, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      return $this->errorResponse('Invalid JSON content in file.', 400);
    }
    return $jsonContent;
  }
  private function saveFile(string  $nameFile, string $file)
  {
    $fileJson = base64_decode($file);
    $fileName = "file_$nameFile" . '_' . time() . '_' . uniqid() . '.json';
    $filePath = "uploads/$fileName";

    Storage::disk('local')->put($filePath, $fileJson);

    return $filePath;
  }

  private function processJson($json)
  {
    $fileRegister  = new FileRegister;
    foreach ($this->chunkJson($json, count($json), 1000) as $jsonProcessed) {
      $fileRegister->insert($jsonProcessed);
    }
  }


  private function deleteFile($filePath)
  {
    Storage::disk('local')->delete($filePath);
  }

  private function chunkJson($jsonRegister, $totalDados, $chunkSize)
  {
    $data = [];
    for ($ii = 0; $ii < $totalDados; $ii++) {
      
      $data[] = $jsonRegister[$ii];

      if ($ii != 0 && $ii % $chunkSize === 0) {
        yield $data;
        $data = [];
      }
    }

    if (!empty($data)) {
      yield $data;
    }
  }
}
