<?php

namespace App\Services;

use App\Repositories\TarifeRepository;
class TarifeService extends BaseService
{
    public function __construct(TarifeRepository $repository)
    {
        $this->repository = $repository;
    }
}
