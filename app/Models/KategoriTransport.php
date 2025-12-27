<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriTransport extends Model
{
    protected $fillable = [
        'kode_kendaraan',
        'nomor_polisi',
        'jenis_kendaraan',
        'merk_tipe',
        'tahun_kendaraan',
        'kapasitas_penumpang',
        'status_kendaraan',
        'tarif_12_jam',
        'tarif_24_jam',
        'tarif_overtime_per_jam',
        'deskripsi',
    ];

    protected $casts = [
        'tarif_12_jam' => 'decimal:2',
        'tarif_24_jam' => 'decimal:2',
        'tarif_overtime_per_jam' => 'decimal:2',
    ];

    /**
     * Get all orders for this category
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'kategori_id');
    }

    /**
     * Get total orders
     */
    public function getTotalOrders()
    {
        return $this->orders()->count();
    }

    /**
     * Get formatted tarif
     */
    public function getFormattedTarif12JamAttribute()
    {
        return 'Rp ' . number_format($this->tarif_12_jam, 0, ',', '.');
    }

    public function getFormattedTarif24JamAttribute()
    {
        return 'Rp ' . number_format($this->tarif_24_jam, 0, ',', '.');
    }

    public function getFormattedTarifOvertimeAttribute()
    {
        return $this->tarif_overtime_per_jam ? 'Rp ' . number_format($this->tarif_overtime_per_jam, 0, ',', '.') : '-';
    }

    /**
     * Get display name
     */
    public function getDisplayNameAttribute()
    {
        return "{$this->merk_tipe} ({$this->nomor_polisi})";
    }

    /**
     * Get tarif by duration
     */
    public function getTarifByDurasi($durasi)
    {
        return match ($durasi) {
            '12_jam' => $this->tarif_12_jam,
            '24_jam' => $this->tarif_24_jam,
            default => null,
        };
    }
}
