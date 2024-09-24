<?php

namespace App\Http\Controllers;

use App\Http\Resources\TarifeResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Tarife;
use App\Services\TarifeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreTarifeRequest;
use App\Http\Requests\UpdateRequest\UpdateTarifeRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TarifeController extends Controller
{
    /**
     * @var TarifeService
     */
    private TarifeService $service;

    /**
     * @param TarifeService $service
     */
    public function __construct(TarifeService $service)
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
        return TarifeResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreTarifeRequest $request
     * @return array|Builder|Collection|Tarife
     * @throws Throwable
     */
    public function store(StoreTarifeRequest $request): array |Builder|Collection|Tarife
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return TarifeResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new TarifeResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateTarifeRequest $request
     * @param int $crudgeneratorId
     * @return array|Tarife|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateTarifeRequest $request, int $crudgeneratorId): array |Tarife|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Tarife
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Tarife
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
