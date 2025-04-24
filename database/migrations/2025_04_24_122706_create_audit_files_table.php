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
            $table->integer('id_file');
            $table->string('file_name');
            $table->enum('file_type', [1,2,3]);
            $table->string('file_path');
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
