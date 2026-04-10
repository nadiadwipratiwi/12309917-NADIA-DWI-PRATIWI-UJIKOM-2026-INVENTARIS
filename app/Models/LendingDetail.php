<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LendingDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'lending_id', 
        'item_id', 
        'quantity'
    ];

    public function lending()
    {
        return $this->belongsTo(Lending::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}

