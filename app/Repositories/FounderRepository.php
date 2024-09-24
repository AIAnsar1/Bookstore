<?php

namespace App\Repositories;

use App\Models\Founder;

class FounderRepository extends BaseRepository
{
    public function __construct(Founder $model)
    {
        parent::__construct($model);
    }
}
