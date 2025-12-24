<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiAkuntansi extends Model
{
    protected $fillable = [
        'akun_id',
        'tipe_transaksi',
        'nominal',
        'tanggal_transaksi',
        'referensi',
        'referensi_type',
        'referensi_id',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'nominal' => 'decimal:2',
    ];

    protected $table = 'transaksi_akuntansis';

    /**
     * Get the account
     */
    public function akun(): BelongsTo
    {
        return $this->belongsTo(AkunAkuntansi::class, 'akun_id');
    }
}
