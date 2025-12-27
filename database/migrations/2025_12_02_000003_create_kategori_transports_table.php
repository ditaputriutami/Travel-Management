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
        Schema::create('kategori_transports', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kendaraan')->unique(); // ID kendaraan (kode internal)
            $table->string('nomor_polisi')->unique(); // Nomor polisi
            $table->enum('jenis_kendaraan', ['mobil', 'bus']); // Jenis kendaraan
            $table->string('merk_tipe'); // Merk dan tipe kendaraan
            $table->year('tahun_kendaraan'); // Tahun kendaraan
            $table->integer('kapasitas_penumpang'); // Kapasitas penumpang
            $table->enum('status_kendaraan', ['tersedia', 'disewa', 'perawatan'])->default('tersedia'); // Status kendaraan
            $table->decimal('tarif_12_jam', 12, 2); // Tarif sewa 12 jam (half day)
            $table->decimal('tarif_24_jam', 12, 2); // Tarif sewa 24 jam (full day)
            $table->decimal('tarif_overtime_per_jam', 12, 2)->nullable(); // Tarif overtime per jam
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_transports');
    }
};
