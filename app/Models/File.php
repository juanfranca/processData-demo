<?php

namespace App\Models;

use App\Enums\FileType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_type', 'file_path', 'file_original_path', 'id_user_file'];


    protected static function booted() {
        static::created(function($file){

            AuditFile::create([
                'id_file' => $file->id,
                'audit_action' => 'created',
                'audit_file_name' => $file->file_name,
                'audit_file_type' => $file->file_type,
                'audit_file_path' => $file->file_path,
                'id_user_log' => 1
            ]);
        });
        static::updated(function($file){

            AuditFile::create([
                'id_file' => $file->id,
                'audit_action' => 'updated',
                'audit_file_name' => $file->file_name,
                'audit_file_type' => $file->file_type,
                'audit_file_path' => $file->file_path,
                'id_user_log' => 1
            ]);
        });
        static::deleted(function($file){
            AuditFile::create([
                'id_file' => $file->id,
                'audit_action' => 'deleted',
                'audit_file_name' => $file->file_name,
                'audit_file_type' => $file->file_type,
                'audit_file_path' => $file->file_path,
                'id_user_log' => 1
            ]);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_file');
    }
}
