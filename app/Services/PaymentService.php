<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
class PaymentService extends BaseService
{
    public function __construct(PaymentRepository $repository)
    {
        $this->repository = $repository;
    }
}
