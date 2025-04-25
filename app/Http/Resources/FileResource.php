<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'file_name' => $this->file_name,
            'file_type' => $this->file_type,
            'id_user' => $this->id_user_file,
            'user' => $this->user->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
