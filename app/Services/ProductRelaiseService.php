<?php

namespace App\Services;

use App\Repositories\ProductRelaiseRepository;
class ProductRelaiseService extends BaseService
{
    public function __construct(ProductRelaiseRepository $repository)
    {
        $this->repository = $repository;
    }
}
