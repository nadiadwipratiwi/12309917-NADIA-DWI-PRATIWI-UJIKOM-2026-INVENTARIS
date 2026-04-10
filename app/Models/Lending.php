<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'lend_date', 
        'return_date', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lendingDetails()
    {
        return $this->hasMany(LendingDetail::class, 'lending_id');
    }
}
