<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository extends BaseRepository
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }
}
