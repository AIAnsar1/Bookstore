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

    protected $casts = [
        'name' => 'array',
        'photo' => 'array',
        'description' => 'array',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
