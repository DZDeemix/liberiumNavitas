<?php

namespace App\Services\Entity;

use App\Models\Company;
use Illuminate\Support\Carbon;

class ForecastEntity extends Entity implements QuantityEntityInterface
{
    public function __construct(array $fields, $date)
    {
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp((int)$date);
        $this->saveData['date'] = Carbon::createFromTimestamp($date);
        parent::__construct($fields);
    }

    public function save(Company $company)
    {
        $company->forecastQuantity()->create($this->saveData);
    }
}
