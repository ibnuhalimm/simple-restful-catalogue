<?php

namespace App\Contracts;

interface BasicApiOperations
{
    public function getAll(int $skip, int $limit);

    public function storeData(array $data);

    public function findById($id);

    public function updateById(array $data, $id);

    public function deleteById($id);

    public function totalRecords();
}