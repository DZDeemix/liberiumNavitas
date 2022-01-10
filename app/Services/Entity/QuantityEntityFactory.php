<?php

namespace App\Services\Entity;

use App\Services\WorksheetCreator;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Whoops\Exception\ErrorException;

class QuantityEntityFactory
{
    public function getInstance(array $fields, $name, $date)
    {
        if ($name === 'fact') {
            return new FactEntity($fields, $date);
        }

        if ($name === 'forecast') {
            return new ForecastEntity($fields, $date);
        }

        throw new ErrorException('Не могу создать сущность');
    }
}
