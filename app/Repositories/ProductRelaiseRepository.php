<?php

namespace App\Repositories;

use App\Models\ProductRelaise;

class ProductRelaiseRepository extends BaseRepository
{
    public function __construct(ProductRelaise $model)
    {
        parent::__construct($model);
    }
}
