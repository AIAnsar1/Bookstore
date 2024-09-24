<?php

namespace App\Repositories;

use App\Models\Tarife;

class TarifeRepository extends BaseRepository
{
    public function __construct(Tarife $model)
    {
        parent::__construct($model);
    }
}
