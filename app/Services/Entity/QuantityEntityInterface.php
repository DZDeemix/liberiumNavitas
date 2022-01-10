<?php

namespace App\Services\Entity;

use App\Models\Company;

interface QuantityEntityInterface
{
    public function save(Company $company);

    public function parse(int $row);
}
