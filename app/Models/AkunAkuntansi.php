<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AkunAkuntansi extends Model
{
    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'jenis',
        'deskripsi',
    ];

    protected $table = 'akun_akuntansis';

    /**
     * Get all transaksi for this account
     */
    public function transaksis(): HasMany
    {
        return $this->hasMany(TransaksiAkuntansi::class, 'akun_id');
    }

    /**
     * Get all orders using this account
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'akun_pendapatan_id');
    }

    /**
     * Get all operational costs using this account
     */
    public function biayaOperasionals(): HasMany
    {
        return $this->hasMany(BiayaOperasional::class, 'akun_beban_id');
    }

    /**
     * Get saldo (balance) for this account
     */
    public function getSaldo()
    {
        $debet = $this->transaksis()->where('tipe_transaksi', 'debet')->sum('nominal');
        $kredit = $this->transaksis()->where('tipe_transaksi', 'kredit')->sum('nominal');

        // Aset dan Beban normal balance is debet
        if (in_array($this->jenis, ['Aset', 'Beban'])) {
            return $debet - $kredit;
        }

        // Utang, Modal, Pendapatan normal balance is kredit
        return $kredit - $debet;
    }
}
