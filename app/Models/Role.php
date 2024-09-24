<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends BaseModel
{
    public $translatable = [];


    protected $fillable = [
        'name',
        'guard_name',
    ];

    protected $casts = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
