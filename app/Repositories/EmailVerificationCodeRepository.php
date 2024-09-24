<?php

namespace App\Repositories;

use App\Models\EmailVerificationCode;

class EmailVerificationCodeRepository extends BaseRepository
{
    public function __construct(EmailVerificationCode $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $email
     * @return \App\Models\BaseModel|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     * @throws \Throwable
     */
    public function findByEmail($email)
    {
        return $this->query()->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-1 hours')))->where('email', $email)->latest('email')->first();
    }
}
