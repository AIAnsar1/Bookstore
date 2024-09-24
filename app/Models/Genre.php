<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends BaseModel
{
    public $translatable = ['title'];

    protected $fillable = [
        'title',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
