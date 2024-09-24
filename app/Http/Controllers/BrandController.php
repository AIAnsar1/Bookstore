<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreBrandRequest;
use App\Http\Requests\UpdateRequest\UpdateBrandRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BrandController extends Controller
{
    /**
     * @var BrandService
     */
    private BrandService $service;

    /**
     * @param BrandService $service
     */
    public function __construct(BrandService $service)
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
        return BrandResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreBrandRequest $request
     * @return array|Builder|Collection|Brand
     * @throws Throwable
     */
    public function store(StoreBrandRequest $request): array |Builder|Collection|Brand
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return BrandResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new BrandResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateBrandRequest $request
     * @param int $crudgeneratorId
     * @return array|Brand|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateBrandRequest $request, int $crudgeneratorId): array |Brand|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Brand
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Brand
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
