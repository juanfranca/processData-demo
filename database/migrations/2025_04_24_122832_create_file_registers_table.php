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
        Schema::create('file_registers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('account');
            $table->decimal('amount', 10,2);
            $table->enum('account_type',['C','D'])->comment('C - Credit, D - Debit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_registers');
    }
};
