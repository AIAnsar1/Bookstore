<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends BaseModel
{
    public $translatable = ['amount'];

    protected $fillable = [
        'amount',
        'user_id',
        'tarif_id',
    ];

    protected $casts = [
        'amount' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tarives()
    {
        return $this->belongsTo(Tarife::class,'tarif_id', 'id');
    }
}
