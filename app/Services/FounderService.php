<?php

namespace App\Services;

use App\Repositories\FounderRepository;
class FounderService extends BaseService
{
    public function __construct(FounderRepository $repository)
    {
        $this->repository = $repository;
    }
}
