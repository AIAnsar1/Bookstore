<?php

namespace App\Models;


class Author extends BaseModel
{
    public $translatable = [
        'name',
        'photo',
        'description',
    ];

    protected $fillable = [
        'name',
        'photo',
        'description',
    ];

    protected $casts = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
