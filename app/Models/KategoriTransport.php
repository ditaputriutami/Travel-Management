<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriTransport extends Model
{
    protected $fillable = [
        'nama_kategori',
        'kapasitas',
        'deskripsi',
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
}
