<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StorePaymentRequest;
use App\Http\Requests\UpdateRequest\UpdatePaymentRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaymentController extends Controller
{
    /**
     * @var PaymentService
     */
    private PaymentService $service;

    /**
     * @param PaymentService $service
     */
    public function __construct(PaymentService $service)
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
        return PaymentResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StorePaymentRequest $request
     * @return array|Builder|Collection|Payment
     * @throws Throwable
     */
    public function store(StorePaymentRequest $request): array |Builder|Collection|Payment
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return PaymentResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new PaymentResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdatePaymentRequest $request
     * @param int $crudgeneratorId
     * @return array|Payment|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdatePaymentRequest $request, int $crudgeneratorId): array |Payment|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Payment
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Payment
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
