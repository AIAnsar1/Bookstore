<?php

namespace App\Models;


class EmailVerificationCode extends BaseModel
{
    protected $table = 'email_verification_code';
    protected $fillable = [
        'code',
        'email',
    ];
    protected $hidden = [
        'code',
    ];
    protected $casts = [];
    public $translatable = [];
}
