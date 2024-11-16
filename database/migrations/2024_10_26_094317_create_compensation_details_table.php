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
        Schema::create('compensation_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_compensation')->constrained(table: 'compensations');
            $table->string('kelas', 10);
            $table->integer('semester');
            $table->integer('jumlah_jam');
            $table->dateTime('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compensation_details');
    }
};
