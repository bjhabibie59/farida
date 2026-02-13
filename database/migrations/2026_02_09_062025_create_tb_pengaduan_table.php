<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->references('id')->on('users'); // siapa yang buat laporan
            $table->string('tgl_pengaduan');   // judul laporan
            $table->text('isi');       // isi laporan
            $table->enum('status', ['menunggu','selesai'])->default('menunggu'); // status laporan
            $table->timestamps();      
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
