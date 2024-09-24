<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreProductRequest;
use App\Http\Requests\UpdateRequest\UpdateProductRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private ProductService $service;

    /**
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
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
        return ProductResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreProductRequest $request
     * @return array|Builder|Collection|Product
     * @throws Throwable
     */
    public function store(StoreProductRequest $request): array |Builder|Collection|Product
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return ProductResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new ProductResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateProductRequest $request
     * @param int $crudgeneratorId
     * @return array|Product|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateProductRequest $request, int $crudgeneratorId): array |Product|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Product
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Product
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
