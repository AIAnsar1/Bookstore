<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    public $translatable = ['title', 'description', 'photo'];

    protected $fillable = [
        'title',
        'description',
        'photo',
        'pdf',
        'selling_method',
        'price',
        'category_id',
        'brand_id',
        'user_id',
        'author_id',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'photo' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function productRelaises()
    {
        return $this->hasMany(ProductRelaise::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * @param array $withCount
     */
    public function scopeFilter($query, $data): void
    {
        if (isset($data['category_id']))
        {
            $query->where('category_id', $data["category_id"]);
        }

        if (isset($data['brand_id']))
        {
            $query->where('brand_id', $data["brand_id"]);
        }

        if (isset($data['author_id']))
        {
            $query->where('author_id', $data["author_id"]);
        }

        if (isset($data['created_data']))
        {
            $query->where('created_data', $data["created_data"]);
        }

        if (isset($data['genre']))
        {
            $query->where('genre', $data["genre"]);
        }

    }
}
