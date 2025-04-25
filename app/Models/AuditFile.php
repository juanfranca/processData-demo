<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditFile extends Model
{
    use HasFactory;

    protected $fillable = ['audit_action','id_file', 'audit_file_name', 'audit_file_type', 'audit_file_path', 'id_user_log'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_log'); 
    }
}
