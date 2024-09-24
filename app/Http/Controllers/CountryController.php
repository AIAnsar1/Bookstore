<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreCountryRequest;
use App\Http\Requests\UpdateRequest\UpdateCountryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CountryController extends Controller
{
    /**
     * @var CountryService
     */
    private CountryService $service;

    /**
     * @param CountryService $service
     */
    public function __construct(CountryService $service)
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
        return CountryResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreCountryRequest $request
     * @return array|Builder|Collection|Country
     * @throws Throwable
     */
    public function store(StoreCountryRequest $request): array |Builder|Collection|Country
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return CountryResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new CountryResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateCountryRequest $request
     * @param int $crudgeneratorId
     * @return array|Country|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateCountryRequest $request, int $crudgeneratorId): array |Country|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Country
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Country
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
