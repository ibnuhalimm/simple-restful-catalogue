<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface RepositoryInterface
{
    /**
     * @return Builder
     */
    public function newQuery(): Builder;

    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): Model;


    /**
     * @param string $uuid
     * @param array $columns
     * @param array $relations
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findByUuid(string $uuid, array $columns = ['*'], array $relations = []): Model;


    /**
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function findByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Model;


    /**
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Collection;


    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;


    /**
     * @param array $criteria
     * @param array $attributes
     * @return void
     */
    public function update(array $criteria, array $attributes): void;


    /**
     * @param array $criteria
     * @return void
     */
    public function delete(array $criteria): void;


    /**
     * @return int
     */
    public function countRecords(): int;


    /**
     * @param array $criteria
     * @return int
     */
    public function countRecordsByCriteria(array $criteria = []): int;
}