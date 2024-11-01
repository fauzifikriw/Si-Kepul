<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WastePriceCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_id',
        'is_valuable', // 0 untuk tidak berharga, 1 untuk berharga
        'amount',
        'unit',
        'price_cost',
    ];

    /**
     * Mendapatkan kategori limbah yang terkait.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function waste()
    {
        return $this->belongsTo(WasteCategory::class, 'waste_id');
    }

    /**
     * Mendapatkan nama kategori limbah untuk keperluan dropdown.
     *
     * @return string
     */
    public function getWasteNameAttribute()
    {
        return $this->waste ? $this->waste->name : 'Tidak Ditemukan';
    }
}
