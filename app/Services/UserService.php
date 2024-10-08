<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;
class UserService extends BaseService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Model|array|Collection|Builder|null
     * @throws Throwable
     */
    public function createModel($data): Model|array|Collection|Builder|null
    {
        $data['password'] = bcrypt($data['password']);
        return parent::createModel($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Model|array|Collection|Builder[]|Builder[]|null
     * @throws Throwable
     */
    public function updateModel($data, $id): Model|array|Collection|Builder|null
    {
        $data['password'] = bcrypt($data['password']);
        return parent::updateModel($data, $id);
    }
}
