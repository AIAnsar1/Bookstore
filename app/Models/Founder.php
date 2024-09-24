<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Founder extends BaseModel
{
    public $translatable = [];


    protected $fillable = [
        "name",
        "description",
        "photo",
    ];

    protected $casts = [];

}
