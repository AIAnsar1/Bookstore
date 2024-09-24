<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Status;
use App\Services\StatusService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreStatusRequest;
use App\Http\Requests\UpdateRequest\UpdateStatusRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StatusController extends Controller
{
    /**
     * @var StatusService
     */
    private StatusService $service;

    /**
     * @param StatusService $service
     */
    public function __construct(StatusService $service)
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
        return StatusResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreStatusRequest $request
     * @return array|Builder|Collection|Status
     * @throws Throwable
     */
    public function store(StoreStatusRequest $request): array |Builder|Collection|Status
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return StatusResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new StatusResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateStatusRequest $request
     * @param int $crudgeneratorId
     * @return array|Status|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateStatusRequest $request, int $crudgeneratorId): array |Status|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Status
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Status
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
