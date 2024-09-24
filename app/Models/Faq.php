<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends BaseModel
{
    public $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];
}
