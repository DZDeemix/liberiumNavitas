<?php

namespace App\Services\Entity;

use App\Models\Company;
use App\Services\WorksheetCreator;

class Entity
{
    private array $fields;
    private $worksheet;
    protected array $saveData;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
        $this->worksheet = WorksheetCreator::getWorksheet();
    }

    public function parse(int $row)
    {
        foreach ($this->fields as $k => $v) {
            $this->saveData[$v] = $this->worksheet->getCell($k . $row)->getValue();
        }
        return $this;
    }
    
}
