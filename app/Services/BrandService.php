<?php

namespace App\Services;

use App\Repositories\BrandRepository;
class BrandService extends BaseService
{
    public function __construct(BrandRepository $repository)
    {
        $this->repository = $repository;
    }
}
