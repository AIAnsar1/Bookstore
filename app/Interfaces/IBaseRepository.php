<?php

namespace App\interfaces;

interface IBaseRepository
{
    /**
     * @param array $data
     * @return mixed
     */
    public function paginatedList(array $data): mixed;

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id): mixed;
}
