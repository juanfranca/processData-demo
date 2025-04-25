<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audit_files', function (Blueprint $table) {
            $table->id();
            $table->string('audit_action');
            $table->integer('id_file');
            $table->string('audit_file_name');
            $table->tinyInteger('audit_file_type');
            $table->string('audit_file_path');
            $table->timestamps();
            

            $table->foreignId('id_user_log')->constrained('users', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_files');
    }
};
