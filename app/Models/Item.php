<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_stock',
        'repair',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Item::class);
    }

    public function lendingDetails()
    {
        return $this->hasMany(lendingDetails::class);
    }
}
