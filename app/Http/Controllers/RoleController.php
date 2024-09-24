<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreRoleRequest;
use App\Http\Requests\UpdateRequest\UpdateRoleRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private RoleService $service;

    /**
     * @param RoleService $service
     */
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws Throwable
     */
    public function index(Request $request)
    {
        return RoleResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreRoleRequest $request
     * @return array|Builder|Collection|Role
     * @throws Throwable
     */
    public function store(StoreRoleRequest $request): array |Builder|Collection|Role
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return RoleResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new RoleResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateRoleRequest $request
     * @param int $crudgeneratorId
     * @return array|Role|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateRoleRequest $request, int $crudgeneratorId): array |Role|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Role
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Role
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
