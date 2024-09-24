<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarife extends BaseModel
{
    public $translatable = ['title'];

    protected $fillable = [
        "title",
    ];

    protected $casts = [];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
