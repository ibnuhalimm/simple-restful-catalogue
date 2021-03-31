<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;


    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function newQuery(): Builder
    {
        return $this->model->newQuery();
    }


    public function findById(int $id, array $columns = ['*'], array $relations = []): Model
    {
        return $this->findByCriteria(['id' => $id], $columns, $relations);
    }


    public function findByUuid(string $uuid, array $columns = ['*'], array $relations = []): Model
    {
        return $this->findByCriteria(['uuid' => $uuid], $columns, $relations);
    }


    public function findByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Model
    {
        return $this->newQuery()->select($columns)->with($relations)->where($criteria)->firstOrFail();
    }


    public function getByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Collection
    {
        return $this->newQuery()->select($columns)->with($relations)->where($criteria)->get();
    }


    public function create(array $attributes): Model
    {
        return $this->newQuery()->create($attributes);
    }


    public function update(array $criteria, array $attributes): void
    {
        $this->newQuery()->where($criteria)->update($attributes);
    }


    public function delete(array $criteria): void
    {
        $this->newQuery()->where($criteria)->delete();
    }


    public function countRecords(): int
    {
        return $this->newQuery()->count();
    }


    public function countRecordsByCriteria(array $criteria = []): int
    {
        return $this->newQuery()->where($criteria)->count();
    }
}