<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'amount', 'decription', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}