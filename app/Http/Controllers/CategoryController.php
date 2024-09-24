<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreCategoryRequest;
use App\Http\Requests\UpdateRequest\UpdateCategoryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private CategoryService $service;

    /**
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
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
        return CategoryResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreCategoryRequest $request
     * @return array|Builder|Collection|Category
     * @throws Throwable
     */
    public function store(StoreCategoryRequest $request): array |Builder|Collection|Category
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return CategoryResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new CategoryResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param int $crudgeneratorId
     * @return array|Category|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateCategoryRequest $request, int $crudgeneratorId): array |Category|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Category
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Category
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
