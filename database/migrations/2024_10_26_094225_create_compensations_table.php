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
        Schema::create('compensations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tugas')->constrained(table: 'tasks');
            $table->foreignId('id_mahasiswa')->constrained(table: 'users');
            $table->foreignId('id_dosen')->nullable()->constrained(table: 'users');
            $table->foreignId('id_kaprodi')->nullable()->constrained(table: 'users');
            $table->enum('acc_dosen', ['terima', 'tolak'])->nullable();
            $table->enum('acc_kaprodi', ['terima', 'tolak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compensations');
    }
};
