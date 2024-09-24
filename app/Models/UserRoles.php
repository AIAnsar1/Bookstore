<?php

namespace App\Models;


class UserRoles extends BaseModel
{
    protected $fillable = [
        'role_code',
        'user_id',
        'status',
    ];
    protected $guarded = [];

    public $translatable = [];

    public function users(): object
    {
        return $this->belongsTo(User::class);
    }
}
