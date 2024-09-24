<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenreResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Genre;
use App\Services\GenreService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreGenreRequest;
use App\Http\Requests\UpdateRequest\UpdateGenreRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GenreController extends Controller
{
    /**
     * @var GenreService
     */
    private GenreService $service;

    /**
     * @param GenreService $service
     */
    public function __construct(GenreService $service)
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
        return GenreResource::collection( $this->service->paginatedList( $request->all() ) );
    }

    /**
     * @param StoreGenreRequest $request
     * @return array|Builder|Collection|Genre
     * @throws Throwable
     */
    public function store(StoreGenreRequest $request): array |Builder|Collection|Genre
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $crudgeneratorId
     * @return GenreResource
     * @throws Throwable
     */
    public function show($crudgeneratorId)
    {
        return new GenreResource( $this->service->getModelById( $crudgeneratorId ));
    }

    /**
     * @param UpdateGenreRequest $request
     * @param int $crudgeneratorId
     * @return array|Genre|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateGenreRequest $request, int $crudgeneratorId): array |Genre|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $crudgeneratorId);

    }

    /**
     * @param int $crudgeneratorId
     * @return array|Builder|Collection|Genre
     * @throws Throwable
     */
    public function destroy(int $crudgeneratorId): array |Builder|Collection|Genre
    {
        return $this->service->deleteModel($crudgeneratorId);
    }
}
