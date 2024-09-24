<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends BaseModel
{
    public $translatable = [];

    protected $fillable = [
        'name',
        'photo',
    ];

    protected $casts = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
