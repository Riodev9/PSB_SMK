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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id('id_berkas');

            $table->foreignId('id_pendaftar')
                ->constrained('pendaftar', 'id_pendaftar')
                ->cascadeOnDelete();

            $table->string('file_path');
            $table->enum('status_berkas', ['menunggu', 'valid', 'tidak_valid'])
                ->default('menunggu');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas');
    }
};
