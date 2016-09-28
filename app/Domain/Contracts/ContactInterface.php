<?php

namespace App\Domain\Contracts;
 /**
 * Interface Paginable
 *
 * @package App\Domain\Contracts
 */

interface ContactInterface {
    
    
    public function paginate($limit = 10, $page = 1, array $column, $field, $search = '');

}