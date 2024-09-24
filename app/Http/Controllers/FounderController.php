<?php

namespace App\Http\Controllers;

use App\Http\Resources\FounderResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Founder;
use App\Services\FounderService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreFounderRequest;
use App\Http\Requests\UpdateRequest\UpdateFounderRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FounderController extends Controller
{
    /**
     * @var FounderService
     */
    private FounderService $service;

    /**
     * @param FounderService $service
     */
    public function __construct(FounderService $service)
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
        return FounderResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreFounderRequest $request
     * @return array|Builder|Collection|Founder
     * @throws Throwable
     */
    public function store(StoreFounderRequest $request): array |Builder|Collection|Founder
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return FounderResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new FounderResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateFounderRequest $request
     * @param int $crudgeneratorId
     * @return array|Founder|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateFounderRequest $request, int $crudgeneratorId): array |Founder|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Founder
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Founder
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
