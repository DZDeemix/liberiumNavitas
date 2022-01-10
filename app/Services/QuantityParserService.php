<?php

namespace App\Services;

use App\Services\Entity\CompanyEntity;
use App\Services\ParseHeadData;
use App\Services\Entity\QuantityEntityFactory;
use App\Services\WorksheetCreator;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class QuantityParserService
{
    private Worksheet $workseet;
    private CompanyEntity $companyEntity;
    private int $startRow;
    private ParseHeadData $parseHeadData;
    private array $company;
    private array $result = ['count' => 0];

    public function __construct(Request $request)
    {
        $this->company = config('quantityParserService.companyCol');
        $this->startRow = config('quantityParserService.startRow');
        new WorksheetCreator($request->file->path());
        $this->workseet = WorksheetCreator::getWorksheet();
    }

    public function readHeader()
    {
        try {
            $this->parseHeadData = ParseHeadData::getInstance();
            $fields = $this->parseHeadData->getFields();
            $quantityEntities = [];
            foreach ($fields as $entityName => $dates) {
                foreach ($dates as $date => $fields) {
                    $quantityEntities[] = (new QuantityEntityFactory())->getInstance($fields, $entityName, $date);
                }
            }

            $this->companyEntity = new CompanyEntity($this->company, $quantityEntities);
        } catch (\Exception $e) {
            $this->result['errors'][] = [
                'message' => 'Неизвестная ошибка'
            ];
        }
    }

    public function parse(): QuantityParserService
    {
        $this->readHeader();
        $this->result = ['count' => 0];
        $row = $this->startRow;
        $highestRow = $this->workseet->getHighestRow();
        for ($row; $row <= $highestRow; ++$row) {
            try {
                $this->companyEntity->parse($row)->save();
            } catch (QueryException $e) {
                $this->result['errors'][] = [
                    'message' => 'Не удалось сохранить в БД',
                    'row' => $row
                ];
                $this->result['count']++;
            } catch (\Exception $e) {
                $this->result['errors'][] = [
                    'message' => 'Неизвестная ошибка',
                    'row' => $row
                ];
                $this->result['count']++;
            }
        }
        return $this;
    }

    public function getResult(): array
    {
        return $this->result;
    }
}
