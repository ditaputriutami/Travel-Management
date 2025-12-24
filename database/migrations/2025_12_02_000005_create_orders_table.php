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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_transports')->onDelete('cascade');
            $table->foreignId('akun_pendapatan_id')->constrained('akun_akuntansis')->onDelete('restrict');
            $table->string('nama_pelanggan');
            $table->string('no_telp');
            $table->date('tanggal_sewa');
            $table->date('tanggal_selesai');
            $table->decimal('total_biaya', 15, 2);
            $table->decimal('uang_muka', 15, 2);
            $table->decimal('denda', 15, 2)->default(0);
            $table->string('jaminan')->nullable();
            $table->enum('status', ['pending', 'aktif', 'selesai', 'dibatalkan'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
