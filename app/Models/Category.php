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

    protected $casts = [];
    public function parents()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
