<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengaduan')->references('id')->on('pengaduan');
            $table->foreignId('id_user')->references('id')->on('users');
            $table->date('tanggal_tanggapan');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};
