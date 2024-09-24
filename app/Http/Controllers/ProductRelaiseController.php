<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductRelaiseResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\ProductRelaise;
use App\Services\ProductRelaiseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreProductRelaiseRequest;
use App\Http\Requests\UpdateRequest\UpdateProductRelaiseRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRelaiseController extends Controller
{
    /**
     * @var ProductRelaiseService
     */
    private ProductRelaiseService $service;

    /**
     * @param ProductRelaiseService $service
     */
    public function __construct(ProductRelaiseService $service)
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
        return ProductRelaiseResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreProductRelaiseRequest $request
     * @return array|Builder|Collection|ProductRelaise
     * @throws Throwable
     */
    public function store(StoreProductRelaiseRequest $request): array |Builder|Collection|ProductRelaise
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return ProductRelaiseResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new ProductRelaiseResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateProductRelaiseRequest $request
     * @param int $crudgeneratorId
     * @return array|ProductRelaise|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateProductRelaiseRequest $request, int $crudgeneratorId): array |ProductRelaise|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|ProductRelaise
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|ProductRelaise
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
