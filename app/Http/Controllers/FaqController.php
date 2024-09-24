<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreFaqRequest;
use App\Http\Requests\UpdateRequest\UpdateFaqRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FaqController extends Controller
{
    /**
     * @var FaqService
     */
    private FaqService $service;

    /**
     * @param FaqService $service
     */
    public function __construct(FaqService $service)
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
        return FaqResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreFaqRequest $request
     * @return array|Builder|Collection|Faq
     * @throws Throwable
     */
    public function store(StoreFaqRequest $request): array |Builder|Collection|Faq
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return FaqResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new FaqResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateFaqRequest $request
     * @param int $crudgeneratorId
     * @return array|Faq|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateFaqRequest $request, int $crudgeneratorId): array |Faq|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Faq
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Faq
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
