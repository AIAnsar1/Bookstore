<?php

namespace App\Repositories;

use App\Models\Status;

class StatusRepository extends BaseRepository
{
    public function __construct(Status $model)
    {
        parent::__construct($model);
    }
}
