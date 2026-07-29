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
        Schema::create('paket_belajars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->cascadeOnDelete();
            $table->foreignId('pengajar_id')->constrained('pengajars')->cascadeOnDelete();
            $table->foreignId('fee_id')->nullable()->constrained('fees')->nullOnDelete();
            $table->string('hari_jam'); // Contoh: "Senin, 16:00"
            $table->integer('jumlah_pertemuan'); // Target paket misal 4x, 8x
            $table->enum('status', ['berjalan', 'menunggu_evaluasi', 'selesai'])->default('berjalan');
            $table->enum('payment_status', ['belum', 'lunas'])->default('belum');
            $table->json('additional_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_belajars');
    }
};
