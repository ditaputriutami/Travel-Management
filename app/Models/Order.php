<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'kategori_id',
        'akun_pendapatan_id',
        'nama_pelanggan',
        'no_telp',
        'tanggal_sewa',
        'tanggal_selesai',
        'total_biaya',
        'uang_muka',
        'denda',
        'jaminan',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_sewa' => 'date',
        'tanggal_selesai' => 'date',
        'total_biaya' => 'decimal:2',
        'uang_muka' => 'decimal:2',
        'denda' => 'decimal:2',
    ];

    /**
     * Get the category of transport
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriTransport::class, 'kategori_id');
    }

    /**
     * Get the revenue account
     */
    public function akunPendapatan(): BelongsTo
    {
        return $this->belongsTo(AkunAkuntansi::class, 'akun_pendapatan_id');
    }

    /**
     * Get sisa pembayaran (balance owed)
     */
    public function getSisaPembayaran()
    {
        $total = $this->total_biaya + $this->denda;
        return $total - $this->uang_muka;
    }

    /**
     * Get formatted status
     */
    public function getStatusBadge()
    {
        $badges = [
            'pending' => 'badge-warning',
            'aktif' => 'badge-primary',
            'selesai' => 'badge-success',
            'dibatalkan' => 'badge-danger',
        ];

        return $badges[$this->status] ?? 'badge-primary';
    }
}
