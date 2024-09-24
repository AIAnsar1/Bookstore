<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRelaise extends BaseModel
{
    public $translatable = ['title','description','pdf'];

    protected $fillable = [
        'product_id',
        'title',
        'description',
        'pdf',
        'status_price',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'pdf' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
