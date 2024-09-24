<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreAuthorRequest;
use App\Http\Requests\UpdateRequest\UpdateAuthorRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorController extends Controller
{
    /**
     * @var AuthorService
     */
    private AuthorService $service;

    /**
     * @param AuthorService $service
     */
    public function __construct(AuthorService $service)
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
        return AuthorResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreAuthorRequest $request
     * @return array|Builder|Collection|Author
     * @throws Throwable
     */
    public function store(StoreAuthorRequest $request): array |Builder|Collection|Author
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $authorId
     * @return AuthorResource
     * @throws Throwable
     */
    public function show($authorId)
    {
        return new AuthorResource( $this->service->getModelById( $authorId ));
    }

    /**
     * @param UpdateAuthorRequest $request
     * @param int $authorId
     * @return array|Author|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateAuthorRequest $request, int $authorId): array |Author|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $authorId);

    }

    /**
     * @param int $authorId
     * @return array|Builder|Collection|Author
     * @throws Throwable
     */
    public function destroy(int $authorId): array |Builder|Collection|Author
    {
        return $this->service->deleteModel($authorId);
    }
}
