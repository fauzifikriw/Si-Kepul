<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WasteCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'recyclable',
        'hazardous',
        'disposal_method',
        'environmental_impact',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(WasteCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(WasteCategory::class, 'parent_id');
    }

    public function priceCost()
    {
        return $this->hasOne(WastePriceCost::class, 'waste_id')->latest('created_at');
    }

    public function latestPriceCost()
    {
        return $this->hasOne(WastePriceCost::class, 'waste_id')->latest('created_at');
    }

}
