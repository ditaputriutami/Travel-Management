<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BiayaOperasional extends Model
{
    protected $fillable = [
        'nama_biaya',
        'nominal',
        'tanggal',
        'akun_beban_id',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
    ];

    /**
     * Get the expense account
     */
    public function akunBeban(): BelongsTo
    {
        return $this->belongsTo(AkunAkuntansi::class, 'akun_beban_id');
    }
}
