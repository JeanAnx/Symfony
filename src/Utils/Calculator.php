<?php

namespace App\Utils;

use App\Repository\AuthorRepository;

class Calculator
{

    public function add(int $a , int $b): int
    {
        return $a + $b;
    }
}