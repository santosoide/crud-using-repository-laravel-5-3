<?php

namespace App\Domain\Contracts;
 /**
 * Interface Paginable
 *
 * @package App\Domain\Contracts
 */

interface ContactInterface {
    
    public function findById($id);
    /**
     * Get data by pagination
     *
     * @param int    $page
     * @param int    $limit
     * @param array  $column
     * @param string $field
     * @param string $search
     *
     * @return mixed
     */
    public function paginate($limit = 10, $page = 1, array $column, $field, $search = '');

}