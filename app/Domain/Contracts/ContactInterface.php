<?php

namespace App\Domain\Contracts;

interface ContactInterface {
    
    public function findById($id);
}