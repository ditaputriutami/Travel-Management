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
        Schema::create('biaya_operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_biaya');
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal');
            $table->foreignId('akun_beban_id')->constrained('akun_akuntansis')->onDelete('restrict');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_operasionals');
    }
};
