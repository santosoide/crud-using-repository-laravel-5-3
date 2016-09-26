<?php

namespace App\Domain\Contracts;

interface Crudable
{
    public function getAll();

    public function paginate($limit, array $column);
}