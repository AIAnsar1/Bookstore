<?php

namespace App\Services;

use App\Repositories\StatusRepository;
class StatusService extends BaseService
{
    public function __construct(StatusRepository $repository)
    {
        $this->repository = $repository;
    }
}
