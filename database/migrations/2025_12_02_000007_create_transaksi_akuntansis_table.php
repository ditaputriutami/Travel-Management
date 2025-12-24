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
        Schema::create('transaksi_akuntansis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_id')->constrained('akun_akuntansis')->onDelete('restrict');
            $table->enum('tipe_transaksi', ['debet', 'kredit']);
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal_transaksi');
            $table->string('referensi')->nullable();
            $table->string('referensi_type')->nullable();
            $table->unsignedBigInteger('referensi_id')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_akuntansis');
    }
};
