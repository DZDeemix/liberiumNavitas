<?php

namespace App\Services\Entity;

use App\Models\Company;
use App\Services\WorksheetCreator;
use Illuminate\Support\Facades\DB;

class CompanyEntity extends Entity implements EntityInterface
{
    private array $quantityEntitys;

    public function __construct(array $fields, array $quantityEntities)
    {
        $this->quantityEntitys = $quantityEntities;
        parent::__construct($fields);
    }
    
    public function parse(int $row)
    {
        foreach ($this->quantityEntitys as $quantityEntity) {
            $quantityEntity->parse($row);
        }
        return parent::parse($row);
    }

    public function save()
    {
        return DB::transaction(function () {
            $company = Company::updateOrCreate($this->saveData, $this->saveData);
            foreach ($this->quantityEntitys as $quantityEntity) {
                $quantityEntity->save($company);
            }
        });
    }
}
