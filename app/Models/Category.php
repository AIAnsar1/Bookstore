<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'parent_id',
        'photo',
    ];

    protected $casts = [
        'name' => 'array',
    ];
    public function parents()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'id', 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
